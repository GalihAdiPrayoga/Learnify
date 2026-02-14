import { motion } from "framer-motion";

const ChatBubble = ({ message, isOwn }) => {
  const time = new Date(message.created_at).toLocaleTimeString("id-ID", {
    hour: "2-digit",
    minute: "2-digit",
  });

  return (
    <motion.div
      initial={{ opacity: 0, y: 10 }}
      animate={{ opacity: 1, y: 0 }}
      className={`flex ${isOwn ? "justify-end" : "justify-start"} mb-3`}
    >
      <div
        className={`max-w-[75%] px-4 py-2.5 rounded-2xl text-sm leading-relaxed ${
          isOwn
            ? "bg-indigo-600 text-white rounded-br-md"
            : "bg-white text-gray-800 border border-gray-200 rounded-bl-md"
        }`}
      >
        {!isOwn && message.sender && (
          <p className="text-xs font-semibold text-indigo-600 mb-1">
            {message.sender.name}
          </p>
        )}
        <p className="whitespace-pre-wrap break-words">{message.body}</p>
        <div
          className={`flex items-center gap-1 mt-1 ${
            isOwn ? "justify-end" : "justify-end"
          }`}
        >
          <span
            className={`text-[10px] ${
              isOwn ? "text-indigo-200" : "text-gray-400"
            }`}
          >
            {time}
          </span>
          {isOwn && (
            <span
              className={`text-[10px] ${
                message.read_at ? "text-indigo-200" : "text-indigo-300/60"
              }`}
            >
              {message.read_at ? "Dibaca" : "Terkirim"}
            </span>
          )}
        </div>
      </div>
    </motion.div>
  );
};

export default ChatBubble;
