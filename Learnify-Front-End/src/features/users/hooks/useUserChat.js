import { useState, useEffect, useRef, useCallback } from "react";
import { chatApi } from "@/services/api/chat.api";
import { getEcho } from "@/services/echo";

export const useUserChat = () => {
  const [messages, setMessages] = useState([]);
  const [conversationId, setConversationId] = useState(null);
  const [loading, setLoading] = useState(true);
  const [sending, setSending] = useState(false);
  const [error, setError] = useState(null);
  const [unreadCount, setUnreadCount] = useState(0);
  const [isOpen, setIsOpen] = useState(false);
  const messagesEndRef = useRef(null);
  const isOpenRef = useRef(false);

  // Keep ref in sync with state for use in event callbacks
  useEffect(() => {
    isOpenRef.current = isOpen;
  }, [isOpen]);

  const fetchChat = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
      const response = await chatApi.getUserChat();
      if (response.success) {
        setConversationId(response.data.conversation_id);
        setMessages(response.data.messages);
      }
    } catch (err) {
      setError(err.response?.data?.message || "Gagal memuat chat");
    } finally {
      setLoading(false);
    }
  }, []);

  const sendMessage = useCallback(async (body) => {
    if (!body.trim()) return;
    setSending(true);
    try {
      const response = await chatApi.userSendMessage(body);
      if (response.success) {
        setMessages((prev) => [...prev, response.data]);
      }
    } catch (err) {
      setError(err.response?.data?.message || "Gagal mengirim pesan");
    } finally {
      setSending(false);
    }
  }, []);

  const markAsRead = useCallback(async () => {
    try {
      await chatApi.userMarkRead();
      setUnreadCount(0);
    } catch {
      // silently fail
    }
  }, []);

  const fetchUnreadCount = useCallback(async () => {
    try {
      const response = await chatApi.getUserUnreadCount();
      if (response.success) {
        setUnreadCount(response.data.unread_count);
      }
    } catch {
      // silently fail
    }
  }, []);

  // Subscribe to realtime channel
  useEffect(() => {
    if (!conversationId) return;

    const echo = getEcho();
    const channel = echo.private(`conversation.${conversationId}`);

    channel.listen(".message.sent", (data) => {
      setMessages((prev) => {
        if (prev.some((m) => m.id === data.id)) return prev;
        return [...prev, data];
      });

      if (isOpenRef.current) {
        markAsRead();
      } else {
        setUnreadCount((prev) => prev + 1);
      }
    });

    return () => {
      echo.leave(`conversation.${conversationId}`);
    };
  }, [conversationId, markAsRead]);

  // Handle reconnection
  useEffect(() => {
    const handleReconnect = () => {
      fetchChat();
    };
    window.addEventListener("echo:reconnected", handleReconnect);
    return () =>
      window.removeEventListener("echo:reconnected", handleReconnect);
  }, [fetchChat]);

  // Initial load
  useEffect(() => {
    fetchChat();
    fetchUnreadCount();
  }, [fetchChat, fetchUnreadCount]);

  // When chat is opened, mark as read
  useEffect(() => {
    if (isOpen && conversationId) {
      markAsRead();
    }
  }, [isOpen, conversationId, markAsRead]);

  // Scroll to bottom on new messages
  useEffect(() => {
    messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
  }, [messages]);

  return {
    messages,
    conversationId,
    loading,
    sending,
    error,
    unreadCount,
    isOpen,
    setIsOpen,
    sendMessage,
    markAsRead,
    messagesEndRef,
  };
};
