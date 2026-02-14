import { useState, useEffect, useRef, useCallback } from "react";
import { chatApi } from "@/services/api/chat.api";
import { getEcho } from "@/services/echo";

export const useAdminChat = () => {
  const [conversations, setConversations] = useState([]);
  const [activeConversation, setActiveConversation] = useState(null);
  const [messages, setMessages] = useState([]);
  const [loading, setLoading] = useState(true);
  const [messagesLoading, setMessagesLoading] = useState(false);
  const [sending, setSending] = useState(false);
  const [error, setError] = useState(null);
  const [totalUnread, setTotalUnread] = useState(0);
  const messagesEndRef = useRef(null);
  const activeChannelRef = useRef(null);
  const activeConversationRef = useRef(null);

  // Keep ref in sync
  useEffect(() => {
    activeConversationRef.current = activeConversation;
  }, [activeConversation]);

  const fetchConversations = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
      const response = await chatApi.getConversations();
      if (response.success) {
        setConversations(response.data);
        const unread = response.data.reduce(
          (sum, c) => sum + (c.unread_count || 0),
          0,
        );
        setTotalUnread(unread);
      }
    } catch (err) {
      setError(err.response?.data?.message || "Gagal memuat percakapan");
    } finally {
      setLoading(false);
    }
  }, []);

  const selectConversation = useCallback(async (conversationId) => {
    setMessagesLoading(true);
    try {
      const response = await chatApi.getConversationMessages(conversationId);
      if (response.success) {
        setActiveConversation(response.data.conversation);
        setMessages(response.data.messages);

        setConversations((prev) =>
          prev.map((c) =>
            c.id === conversationId ? { ...c, unread_count: 0 } : c,
          ),
        );
      }
    } catch (err) {
      setError(err.response?.data?.message || "Gagal memuat pesan");
    } finally {
      setMessagesLoading(false);
    }
  }, []);

  const sendMessage = useCallback(
    async (body) => {
      if (!body.trim() || !activeConversation) return;
      setSending(true);
      try {
        const response = await chatApi.adminSendMessage(
          activeConversation.id,
          body,
        );
        if (response.success) {
          setMessages((prev) => [...prev, response.data]);

          setConversations((prev) =>
            prev.map((c) =>
              c.id === activeConversation.id
                ? {
                    ...c,
                    latest_message: response.data,
                    last_message_at: new Date().toISOString(),
                  }
                : c,
            ),
          );
        }
      } catch (err) {
        setError(err.response?.data?.message || "Gagal mengirim pesan");
      } finally {
        setSending(false);
      }
    },
    [activeConversation],
  );

  // Subscribe to active conversation channel
  useEffect(() => {
    if (!activeConversation) return;

    const echo = getEcho();

    // Leave previous channel
    if (activeChannelRef.current) {
      echo.leave(`conversation.${activeChannelRef.current}`);
    }

    const channel = echo.private(`conversation.${activeConversation.id}`);

    channel.listen(".message.sent", (data) => {
      setMessages((prev) => {
        if (prev.some((m) => m.id === data.id)) return prev;
        return [...prev, data];
      });
    });

    activeChannelRef.current = activeConversation.id;

    return () => {
      echo.leave(`conversation.${activeConversation.id}`);
      activeChannelRef.current = null;
    };
  }, [activeConversation?.id]);

  // Subscribe to admin-wide notification channel
  useEffect(() => {
    const echo = getEcho();
    const channel = echo.private("admin.chats");

    channel.listen(".new.message", (data) => {
      setConversations((prev) => {
        const existing = prev.find((c) => c.id === data.conversation_id);
        let updated;

        if (existing) {
          updated = prev.map((c) => {
            if (c.id === data.conversation_id) {
              const isViewing =
                activeConversationRef.current?.id === data.conversation_id;
              return {
                ...c,
                unread_count: isViewing ? 0 : (c.unread_count || 0) + 1,
                latest_message: {
                  body: data.message_preview,
                  created_at: new Date().toISOString(),
                  sender_role: "User",
                },
                last_message_at: new Date().toISOString(),
              };
            }
            return c;
          });
        } else {
          // New conversation from a user we haven't seen yet - refetch
          fetchConversations();
          return prev;
        }

        return updated.sort(
          (a, b) => new Date(b.last_message_at) - new Date(a.last_message_at),
        );
      });

      if (activeConversationRef.current?.id !== data.conversation_id) {
        setTotalUnread((prev) => prev + 1);
      }
    });

    return () => {
      echo.leave("admin.chats");
    };
  }, [fetchConversations]);

  // Handle reconnection
  useEffect(() => {
    const handleReconnect = () => {
      fetchConversations();
      if (activeConversationRef.current) {
        selectConversation(activeConversationRef.current.id);
      }
    };
    window.addEventListener("echo:reconnected", handleReconnect);
    return () =>
      window.removeEventListener("echo:reconnected", handleReconnect);
  }, [fetchConversations, selectConversation]);

  // Initial load
  useEffect(() => {
    fetchConversations();
  }, [fetchConversations]);

  // Scroll to bottom on new messages
  useEffect(() => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
  }, [messages]);

  return {
    conversations,
    activeConversation,
    messages,
    loading,
    messagesLoading,
    sending,
    error,
    totalUnread,
    selectConversation,
    sendMessage,
    fetchConversations,
    messagesEndRef,
  };
};
