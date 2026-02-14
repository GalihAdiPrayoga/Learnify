import axiosInstance from "./axios";

export const chatApi = {
  // ========== USER ENDPOINTS ==========

  getUserChat: async () => {
    const response = await axiosInstance.get("/user/chat");
    return response.data;
  },

  userSendMessage: async (body) => {
    const response = await axiosInstance.post("/user/chat/send", { body });
    return response.data;
  },

  userMarkRead: async () => {
    const response = await axiosInstance.post("/user/chat/read");
    return response.data;
  },

  getUserUnreadCount: async () => {
    const response = await axiosInstance.get("/user/chat/unread-count");
    return response.data;
  },

  // ========== ADMIN ENDPOINTS ==========

  getConversations: async () => {
    const response = await axiosInstance.get("/admin/chat/conversations");
    return response.data;
  },

  getConversationMessages: async (conversationId) => {
    const response = await axiosInstance.get(
      `/admin/chat/conversations/${conversationId}`,
    );
    return response.data;
  },

  adminSendMessage: async (conversationId, body) => {
    const response = await axiosInstance.post(
      `/admin/chat/conversations/${conversationId}/send`,
      { body },
    );
    return response.data;
  },

  getAdminUnreadCount: async () => {
    const response = await axiosInstance.get("/admin/chat/unread-count");
    return response.data;
  },
};
