import React from "react";
import {
  ArrowLeft,
  BookOpen,
  Clock,
  CheckCircle,
  Bookmark,
  Lock,
} from "lucide-react";

const MaterialItem = ({
  material,
  index,
  isCompleted,
  isLocked = false,
  isCurrentActive = false,
  isToggling,
  onOpen,
  onToggle,
}) => {
  const handleClick = () => {
    if (isLocked) return;
    onOpen(material.id);
  };

  // Determine status label and styling
  let statusLabel = "";
  let statusColor = "";
  if (isLocked) {
    statusLabel = "Terkunci";
    statusColor = "text-gray-400 bg-gray-100";
  } else if (isCompleted) {
    statusLabel = "Selesai";
    statusColor = "text-green-700 bg-green-100";
  } else if (isCurrentActive) {
    statusLabel = "Sedang Berjalan";
    statusColor = "text-blue-700 bg-blue-100";
  } else {
    statusLabel = "Belum Dimulai";
    statusColor = "text-gray-500 bg-gray-100";
  }

  return (
    <div
      onClick={handleClick}
      className={`bg-white border-2 rounded-xl p-6 transition-all duration-300 group ${
        isLocked
          ? "border-gray-200 opacity-60 cursor-not-allowed"
          : isCompleted
            ? "border-green-200 bg-green-50/30 hover:shadow-lg cursor-pointer"
            : isCurrentActive
              ? "border-blue-300 bg-blue-50/30 hover:shadow-lg cursor-pointer ring-2 ring-blue-200"
              : "border-gray-200 hover:border-gray-400 hover:shadow-lg cursor-pointer"
      }`}
    >
      <div className="flex items-start gap-4">
        <div
          className={`shrink-0 w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg transition-transform ${
            isLocked
              ? "bg-gray-300 text-gray-500"
              : isCompleted
                ? "bg-green-500 text-white group-hover:scale-110"
                : isCurrentActive
                  ? "bg-linear-to-br from-blue-500 to-purple-600 text-white group-hover:scale-110 animate-pulse"
                  : "bg-linear-to-br from-blue-500 to-purple-600 text-white group-hover:scale-110"
          }`}
        >
          {isLocked ? (
            <Lock className="w-6 h-6" />
          ) : isCompleted ? (
            <CheckCircle className="w-6 h-6" />
          ) : (
            index + 1
          )}
        </div>

        <div className="flex-1">
          <div className="flex items-start justify-between gap-2">
            <div>
              <h3
                className={`text-xl font-bold mb-1 transition ${
                  isLocked
                    ? "text-gray-400"
                    : isCompleted
                      ? "text-green-700 group-hover:text-green-800"
                      : isCurrentActive
                        ? "text-blue-700 group-hover:text-blue-800"
                        : "text-gray-900 group-hover:text-blue-600"
                }`}
              >
                {material.judul}
              </h3>
              <span
                className={`inline-block text-xs font-semibold px-2 py-0.5 rounded-full ${statusColor}`}
              >
                {statusLabel}
              </span>
            </div>

            {!isLocked && (
              <button
                onClick={(e) => {
                  e.stopPropagation();
                  onToggle(e, material.id);
                }}
                className="ml-3 p-1 rounded-md hover:bg-gray-100"
                title={isCompleted ? "Batal selesai" : "Tandai selesai"}
                disabled={isToggling}
              >
                {isToggling ? (
                  <div className="w-5 h-5 border-2 border-gray-300 border-t-transparent rounded-full animate-spin" />
                ) : isCompleted ? (
                  <Bookmark className="w-5 h-5 text-indigo-700" />
                ) : (
                  <Bookmark className="w-5 h-5 text-gray-400 opacity-60" />
                )}
              </button>
            )}
          </div>

          <p
            className={`mb-3 line-clamp-2 ${isLocked ? "text-gray-400" : "text-gray-600"}`}
          >
            {material.deskripsi}
          </p>

          <div
            className={`flex items-center gap-4 text-sm ${isLocked ? "text-gray-400" : "text-gray-500"}`}
          >
            <span className="flex items-center gap-1">
              <BookOpen className="w-4 h-4" />
              Materi
            </span>
            <span className="flex items-center gap-1">
              <Clock className="w-4 h-4" />
              {new Date(material.created_at).toLocaleDateString("id-ID")}
            </span>
          </div>
        </div>

        <div className="shrink-0">
          {isLocked ? (
            <div className="w-10 h-10 rounded-full flex items-center justify-center bg-gray-100">
              <Lock className="w-5 h-5 text-gray-400" />
            </div>
          ) : (
            <div
              className={`w-10 h-10 rounded-full flex items-center justify-center transition ${
                isCompleted
                  ? "bg-green-100 group-hover:bg-green-200"
                  : "bg-gray-100 group-hover:bg-blue-100"
              }`}
            >
              <ArrowLeft
                className={`w-5 h-5 rotate-180 transition ${
                  isCompleted
                    ? "text-green-600"
                    : "text-gray-600 group-hover:text-blue-600"
                }`}
              />
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default React.memo(MaterialItem);
