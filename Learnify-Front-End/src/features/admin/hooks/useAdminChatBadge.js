import { useState, useEffect, useCallback } from "react";
import { chatApi } from "@/services/api/chat.api";
import { getEcho } from "@/services/echo";

export const useAdminChatBadge = () => {
  const [unreadCount, setUnreadCount] = useState(0);

  const fetchUnreadCount = useCallback(async () => {
    try {
      const response = await chatApi.getAdminUnreadCount();
      if (response.success) {
        setUnreadCount(response.data.unread_count);
      }
    } catch {
      // silently fail
    }
  }, []);

  useEffect(() => {
    fetchUnreadCount();

    const echo = getEcho();
    const channel = echo.private("admin.chats");

    channel.listen(".new.message", () => {
      setUnreadCount((prev) => prev + 1);
    });

    return () => {
      echo.leave("admin.chats");
    };
  }, [fetchUnreadCount]);

  return { unreadCount, resetCount: () => setUnreadCount(0) };
};
