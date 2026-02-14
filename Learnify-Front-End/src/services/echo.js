import Echo from "laravel-echo";
import Pusher from "pusher-js";
import { getToken } from "@/services/storage/token";

window.Pusher = Pusher;

let echoInstance = null;

export const getEcho = () => {
  if (echoInstance) return echoInstance;

  echoInstance = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authorizer: (channel) => {
      return {
        authorize: (socketId, callback) => {
          const token = getToken();
          fetch(`${import.meta.env.VITE_API_BASE_URL}/broadcasting/auth`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              Accept: "application/json",
              Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({
              socket_id: socketId,
              channel_name: channel.name,
            }),
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error(`Auth failed: ${response.status}`);
              }
              return response.json();
            })
            .then((data) => callback(null, data))
            .catch((error) => callback(error));
        },
      };
    },
  });

  echoInstance.connector.pusher.connection.bind("connected", () => {
    console.log("[Echo] Connected to Pusher");
  });

  echoInstance.connector.pusher.connection.bind("reconnected", () => {
    console.log("[Echo] Reconnected to Pusher");
    window.dispatchEvent(new CustomEvent("echo:reconnected"));
  });

  return echoInstance;
};

export const disconnectEcho = () => {
  if (echoInstance) {
    echoInstance.disconnect();
    echoInstance = null;
  }
};
