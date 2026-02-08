import { motion } from "framer-motion";
import SuccessImg from "@/assets/Success.svg";

export default function ResultSummary({ hasil, passed }) {
  return (
    <motion.div
      initial={{ opacity: 0, y: 8 }}
      animate={{ opacity: 1, y: 0 }}
      className="mt-6 rounded-lg p-8 text-center"
    >
      <div className="max-w-2xl mx-auto flex flex-col items-center gap-6">
        <div className="flex justify-center">
          <img
            src={SuccessImg}
            alt="Result"
            className="w-64 h-64 object-contain"
          />
        </div>

        <h2 className="text-6xl font-extrabold mt-4 mb-2 text-gray-900">
          {hasil.nilai}
        </h2>

        <p className="text-lg font-semibold text-gray-600 mb-1">
          Kamu berhasil menjawab {hasil.jumlah_benar} benar dari{" "}
          {hasil.jumlah_soal} soal
        </p>

        <div
          className={`mt-2 px-6 py-3 rounded-xl ${
            passed
              ? "bg-green-100 border border-green-300"
              : "bg-red-100 border border-red-300"
          }`}
        >
          <p
            className={`text-2xl font-bold ${
              passed ? "text-green-700" : "text-red-700"
            }`}
          >
            {passed ? "Selamat! Anda Lulus" : "Belum Lulus"}
          </p>
          {passed ? (
            <p className="text-green-600 text-sm mt-1">
              Materi telah ditandai selesai secara otomatis.
            </p>
          ) : (
            <p className="text-red-600 text-sm mt-1">
              Nilai minimum kelulusan adalah 70. Silakan coba lagi.
            </p>
          )}
        </div>
      </div>
    </motion.div>
  );
}
