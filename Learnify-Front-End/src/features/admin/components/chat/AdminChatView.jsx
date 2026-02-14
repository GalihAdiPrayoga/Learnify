import { useState, useRef } from "react";
import { Send, Loader2, MessageCircle } from "lucide-react";
import { motion } from "framer-motion";
import { STORAGE_URL } from "@/services/api/axios";

const AdminChatView = ({
  conversation,
  messages,
  messagesLoading,
  sending,
  onSend,
  messagesEndRef,
}) => {
  const [inputValue, setInputValue] = useState("");
  const inputRef = useRef(null);

  const handleSend = async () => {
    if (!inputValue.trim() || sending) return;
    const text = inputValue;
    setInputValue("");
    await onSend(text);
    inputRef.current?.focus();
  };

  const handleKeyDown = (e) => {
    if (e.key === "Enter" && !e.shiftKey) {
      e.preventDefault();
      handleSend();
    }
  };

  if (!conversation) {
    return (
      <div className="flex-1 flex flex-col items-center justify-center text-gray-400 bg-gray-50">
        <MessageCircle className="w-16 h-16 mb-4 text-gray-300" />
        <h3 className="text-lg font-semibold text-gray-500">
          Pilih Percakapan
        </h3>
        <p className="text-sm mt-1">
          Pilih percakapan dari daftar di samping untuk mulai membalas
        </p>
      </div>
    );
  }

  const getInitials = (name) => {
    if (!name) return "?";
    return name
      .split(" ")
      .map((n) => n[0])
      .join("")
      .substring(0, 2)
      .toUpperCase();
  };

  return (
    <div className="flex-1 flex flex-col bg-gray-50 h-full min-w-0">
      {/* Conversation Header */}
      <div className="bg-white border-b border-gray-200 px-6 py-4 flex items-center gap-3 shrink-0">
        <div className="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold overflow-hidden shrink-0">
          {conversation.user?.profile ? (
            <img
              src={`${STORAGE_URL}/${conversation.user.profile}`}
              alt={conversation.user.name}
              className="w-full h-full object-cover"
            />
          ) : (
            getInitials(conversation.user?.name)
          )}
        </div>
        <div className="min-w-0">
          <h3 className="font-semibold text-gray-900 truncate">
            {conversation.user?.name}
          </h3>
          <p className="text-xs text-gray-500 truncate">
            {conversation.user?.email}
          </p>
        </div>
      </div>

      {/* Messages */}
      <div className="flex-1 overflow-y-auto px-6 py-4">
        {messagesLoading ? (
          <div className="flex items-center justify-center h-full">
            <Loader2 className="w-6 h-6 text-indigo-500 animate-spin" />
          </div>
        ) : messages.length === 0 ? (
          <div className="flex flex-col items-center justify-center h-full text-gray-400">
            <MessageCircle className="w-12 h-12 mb-3 text-gray-300" />
            <p className="text-sm">Belum ada pesan dalam percakapan ini</p>
          </div>
        ) : (
          messages.map((msg) => {
            const isAdmin = msg.sender_role === "Admin";
            const time = new Date(msg.created_at).toLocaleTimeString("id-ID", {
              hour: "2-digit",
              minute: "2-digit",
            });

            return (
              <motion.div
                key={msg.id}
                initial={{ opacity: 0, y: 10 }}
                animate={{ opacity: 1, y: 0 }}
                className={`flex ${
                  isAdmin ? "justify-end" : "justify-start"
                } mb-3`}
              >
                <div
                  className={`max-w-[65%] px-4 py-2.5 rounded-2xl text-sm leading-relaxed ${
                    isAdmin
                      ? "bg-indigo-600 text-white rounded-br-md"
                      : "bg-white text-gray-800 border border-gray-200 rounded-bl-md"
                  }`}
                >
                  {!isAdmin && msg.sender && (
                    <p className="text-xs font-semibold text-indigo-600 mb-1">
                      {msg.sender.name}
                    </p>
                  )}
                  <p className="whitespace-pre-wrap break-words">{msg.body}</p>
                  <div className={`flex items-center gap-1 mt-1 justify-end`}>
                    <span
                      className={`text-[10px] ${
                        isAdmin ? "text-indigo-200" : "text-gray-400"
                      }`}
                    >
                      {time}
                    </span>
                    {isAdmin && (
                      <span
                        className={`text-[10px] ${
                          msg.read_at ? "text-indigo-200" : "text-indigo-300/60"
                        }`}
                      >
                        {msg.read_at ? "Dibaca" : "Terkirim"}
                      </span>
                    )}
                  </div>
                </div>
              </motion.div>
            );
          })
        )}
        <div ref={messagesEndRef} />
      </div>

      {/* Input */}
      <div className="border-t border-gray-200 px-6 py-4 bg-white shrink-0">
        <div className="flex items-end gap-3">
          <textarea
            ref={inputRef}
            value={inputValue}
            onChange={(e) => setInputValue(e.target.value)}
            onKeyDown={handleKeyDown}
            placeholder="Ketik balasan..."
            rows={1}
            className="flex-1 resize-none border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition max-h-24 overflow-y-auto"
          />
          <button
            onClick={handleSend}
            disabled={!inputValue.trim() || sending}
            className="px-5 py-2.5 bg-indigo-600 text-white rounded-xl flex items-center gap-2 hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed text-sm font-medium shrink-0"
          >
            {sending ? (
              <Loader2 className="w-4 h-4 animate-spin" />
            ) : (
              <Send className="w-4 h-4" />
            )}
            Kirim
          </button>
        </div>
      </div>
    </div>
  );
};

export default AdminChatView;
