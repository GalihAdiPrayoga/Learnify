import { useAdminChat } from "../hooks/useAdminChat";
import ConversationList from "../components/chat/ConversationList";
import AdminChatView from "../components/chat/AdminChatView";
import HeaderCard from "../components/HeaderCard";
import Loading from "@/components/Loading";

export default function ChatPage() {
  const {
    conversations,
    activeConversation,
    messages,
    loading,
    messagesLoading,
    sending,
    error,
    selectConversation,
    sendMessage,
    messagesEndRef,
  } = useAdminChat();

  if (loading) return <Loading />;

  return (
    <div>
      

      {error && (
        <div className="mb-4 text-center text-red-500 text-sm">{error}</div>
      )}

      <div className="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex h-[calc(100vh-7rem)]">
        <ConversationList
          conversations={conversations}
          activeId={activeConversation?.id}
          onSelect={selectConversation}
        />
        <AdminChatView
          conversation={activeConversation}
          messages={messages}
          messagesLoading={messagesLoading}
          sending={sending}
          onSend={sendMessage}
          messagesEndRef={messagesEndRef}
        />
      </div>
    </div>
  );
}
