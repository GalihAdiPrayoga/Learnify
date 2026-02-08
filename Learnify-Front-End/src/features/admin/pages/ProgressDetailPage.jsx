import React from "react";
import { useParams, useNavigate } from "react-router-dom";
import { useAdminProgressDetail } from "../hooks/useAdminProgress";
import Loading from "@/components/Loading";
import HeaderCard from "../components/HeaderCard";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";
import {
  User,
  Mail,
  Calendar,
  BookOpen,
  CheckCircle,
  XCircle,
  Award,
  Download,
  GraduationCap,
  Clock,
  Target,
} from "lucide-react";

const ProgressDetailPage = () => {
  const { userId } = useParams();
  const navigate = useNavigate();
  const { data, loading, error } = useAdminProgressDetail(userId);

  if (loading) return <Loading />;
  if (error || !data) {
    return (
      <div className="p-6">
        <p className="text-center text-red-500">
          {error || "Data tidak ditemukan"}
        </p>
      </div>
    );
  }

  const { user, courses } = data;

  const completedCourses = courses.filter((c) => c.status === "completed");
  const activeCourses = courses.filter((c) => c.status !== "completed");

  const handleExportPDF = () => {
    const doc = new jsPDF();
    doc.setFontSize(16);
    doc.text(`Detail Progres - ${user.name}`, 14, 20);
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text(`Email: ${user.email}`, 14, 28);
    doc.text(`Kursus Diikuti: ${courses.length} | Selesai: ${completedCourses.length} | Aktif: ${activeCourses.length}`, 14, 34);

    let startY = 44;

    courses.forEach((course) => {
      doc.setFontSize(12);
      doc.setTextColor(0);
      doc.text(`${course.nama} (${course.progress}%) - ${course.status === "completed" ? "Selesai" : "Aktif"}`, 14, startY);
      startY += 6;

      // Materials table
      doc.setFontSize(9);
      doc.setTextColor(80);
      doc.text("Daftar Materi:", 14, startY);
      startY += 2;

      autoTable(doc, {
        startY,
        head: [["No", "Materi", "Status"]],
        body: course.materials.map((m, i) => [
          i + 1,
          `${m.urutan}. ${m.judul}`,
          m.is_completed ? "Selesai" : "Belum",
        ]),
        styles: { fontSize: 8 },
        headStyles: { fillColor: [79, 70, 229] },
        margin: { left: 14 },
      });

      startY = doc.lastAutoTable.finalY + 4;

      // Exam results
      if (course.exam_results.length > 0) {
        doc.setFontSize(9);
        doc.setTextColor(80);
        doc.text("Hasil Ujian:", 14, startY);
        startY += 2;

        autoTable(doc, {
          startY,
          head: [["Materi", "Tanggal", "Nilai", "Benar", "Status"]],
          body: course.exam_results.map((exam) => [
            exam.materi_judul || "-",
            new Date(exam.created_at).toLocaleDateString("id-ID", { day: "numeric", month: "short", year: "numeric" }),
            exam.nilai,
            `${exam.jumlah_benar}/${exam.jumlah_soal}`,
            exam.lulus ? "Lulus" : "Tidak Lulus",
          ]),
          styles: { fontSize: 8 },
          headStyles: { fillColor: [16, 185, 129] },
          margin: { left: 14 },
        });

        startY = doc.lastAutoTable.finalY + 8;
      } else {
        startY += 4;
      }

      if (startY > 250) {
        doc.addPage();
        startY = 20;
      }
    });

    doc.save(`progres-${user.name.replace(/\s+/g, "-").toLowerCase()}.pdf`);
  };

  return (
    <div className="p-6">
      <div className="print:hidden">
        <HeaderCard
          title="Detail Progres Pengguna"
          subtitle={user.name}
          showBack
          onBack={() => navigate("/admin/progress")}
        />
      </div>

      {/* User Info Card */}
      <div className="mt-6 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div className="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
          <div className="flex items-center gap-4">
            <div className="w-16 h-16 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-white text-xl font-bold border-2 border-white/30">
              {user.name
                ?.split(" ")
                .map((n) => n[0])
                .join("")
                .substring(0, 2)
                .toUpperCase() || "?"}
            </div>
            <div className="text-white">
              <h2 className="text-xl font-bold">{user.name}</h2>
              <p className="text-indigo-200 text-sm">{user.email}</p>
            </div>
            <button
              onClick={handleExportPDF}
              className="ml-auto print:hidden flex items-center gap-2 px-4 py-2 bg-white/15 backdrop-blur text-white rounded-xl hover:bg-white/25 transition text-sm font-medium border border-white/20"
            >
              <Download className="w-4 h-4" />
              Cetak
            </button>
          </div>
        </div>
        <div className="px-6 py-4 flex flex-wrap gap-6">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
              <BookOpen className="w-5 h-5 text-blue-600" />
            </div>
            <div>
              <p className="text-xs text-gray-500 font-medium">
                Kursus Diikuti
              </p>
              <p className="text-lg font-bold text-gray-900">
                {courses.length}
              </p>
            </div>
          </div>
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
              <CheckCircle className="w-5 h-5 text-green-600" />
            </div>
            <div>
              <p className="text-xs text-gray-500 font-medium">Selesai</p>
              <p className="text-lg font-bold text-gray-900">
                {completedCourses.length}
              </p>
            </div>
          </div>
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
              <Clock className="w-5 h-5 text-amber-600" />
            </div>
            <div>
              <p className="text-xs text-gray-500 font-medium">
                Sedang Berjalan
              </p>
              <p className="text-lg font-bold text-gray-900">
                {activeCourses.length}
              </p>
            </div>
          </div>
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
              <Calendar className="w-5 h-5 text-purple-600" />
            </div>
            <div>
              <p className="text-xs text-gray-500 font-medium">Bergabung</p>
              <p className="text-sm font-semibold text-gray-900">
                {new Date(user.created_at).toLocaleDateString("id-ID", {
                  day: "numeric",
                  month: "long",
                  year: "numeric",
                })}
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Courses */}
      <div className="mt-6 space-y-5">
        {courses.length === 0 ? (
          <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center text-gray-500">
            <GraduationCap className="w-12 h-12 mx-auto text-gray-300 mb-3" />
            <p className="font-medium">
              Pengguna belum mengikuti kursus apapun.
            </p>
          </div>
        ) : (
          courses.map((course) => (
            <div
              key={course.id}
              className="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden"
            >
              {/* Course Header */}
              <div className="p-6 border-b border-gray-100">
                <div className="flex items-start justify-between gap-4">
                  <div className="flex-1">
                    <div className="flex items-center gap-3">
                      <div
                        className={`w-10 h-10 rounded-lg flex items-center justify-center ${
                          course.status === "completed"
                            ? "bg-green-100"
                            : "bg-indigo-100"
                        }`}
                      >
                        {course.status === "completed" ? (
                          <CheckCircle className="w-5 h-5 text-green-600" />
                        ) : (
                          <Target className="w-5 h-5 text-indigo-600" />
                        )}
                      </div>
                      <div>
                        <h3 className="text-lg font-bold text-gray-900">
                          {course.nama}
                        </h3>
                        <div className="flex items-center gap-4 mt-1 text-sm text-gray-500">
                          <span className="flex items-center gap-1">
                            <BookOpen className="w-3.5 h-3.5" />
                            {course.completed_materials_count}/
                            {course.total_materials} Materi
                          </span>
                          <span className="flex items-center gap-1">
                            <Calendar className="w-3.5 h-3.5" />
                            Mulai:{" "}
                            {new Date(
                              course.enrolled_at,
                            ).toLocaleDateString("id-ID", {
                              day: "numeric",
                              month: "short",
                              year: "numeric",
                            })}
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="flex items-center gap-2 shrink-0">
                    <span
                      className={`px-3 py-1.5 rounded-lg text-xs font-semibold ${
                        course.status === "completed"
                          ? "bg-green-100 text-green-700"
                          : "bg-blue-100 text-blue-700"
                      }`}
                    >
                      {course.status === "completed" ? "Selesai" : "Aktif"}
                    </span>
                    {course.certificate && (
                      <span className="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700">
                        <Award className="w-3 h-3" />
                        Sertifikat
                      </span>
                    )}
                  </div>
                </div>

                {/* Progress Bar */}
                <div className="mt-4 flex items-center gap-3">
                  <div className="flex-1 h-3 bg-gray-100 rounded-full overflow-hidden">
                    <div
                      className={`h-full rounded-full transition-all duration-500 ${
                        course.progress >= 100
                          ? "bg-gradient-to-r from-green-400 to-emerald-500"
                          : "bg-gradient-to-r from-indigo-400 to-indigo-600"
                      }`}
                      style={{ width: `${course.progress}%` }}
                    />
                  </div>
                  <span className="text-sm font-bold text-gray-700 min-w-[40px] text-right">
                    {course.progress}%
                  </span>
                </div>
              </div>

              {/* Materials */}
              <div className="p-5">
                <h4 className="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                  <BookOpen className="w-4 h-4 text-gray-400" />
                  Daftar Materi
                </h4>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-2">
                  {course.materials.map((m) => (
                    <div
                      key={m.id}
                      className={`flex items-center gap-3 text-sm px-3 py-2.5 rounded-lg border ${
                        m.is_completed
                          ? "bg-green-50 border-green-200"
                          : "bg-gray-50 border-gray-200"
                      }`}
                    >
                      {m.is_completed ? (
                        <CheckCircle className="w-4 h-4 text-green-500 shrink-0" />
                      ) : (
                        <XCircle className="w-4 h-4 text-gray-300 shrink-0" />
                      )}
                      <span
                        className={`font-medium ${
                          m.is_completed ? "text-green-700" : "text-gray-600"
                        }`}
                      >
                        {m.urutan}. {m.judul}
                      </span>
                    </div>
                  ))}
                </div>
              </div>

              {/* Exam Results */}
              {course.exam_results.length > 0 && (
                <div className="px-5 pb-5 pt-0">
                  <h4 className="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                    <Target className="w-4 h-4 text-gray-400" />
                    Hasil Ujian
                  </h4>
                  <div className="overflow-x-auto rounded-lg border border-gray-200">
                    <table className="w-full text-sm">
                      <thead>
                        <tr className="bg-gray-50 border-b border-gray-200">
                          <th className="text-left p-3 font-semibold text-gray-600">
                            Materi
                          </th>
                          <th className="text-left p-3 font-semibold text-gray-600">
                            Tanggal
                          </th>
                          <th className="text-center p-3 font-semibold text-gray-600">
                            Nilai
                          </th>
                          <th className="text-center p-3 font-semibold text-gray-600">
                            Benar
                          </th>
                          <th className="text-center p-3 font-semibold text-gray-600">
                            Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        {course.exam_results.map((exam) => (
                          <tr
                            key={exam.id}
                            className="border-b border-gray-100 last:border-b-0"
                          >
                            <td className="p-3 text-gray-700 font-medium">
                              {exam.materi_judul || "-"}
                            </td>
                            <td className="p-3 text-gray-600">
                              {new Date(
                                exam.created_at,
                              ).toLocaleDateString("id-ID", {
                                day: "numeric",
                                month: "short",
                                year: "numeric",
                              })}
                            </td>
                            <td className="p-3 text-center">
                              <span
                                className={`font-bold text-lg ${
                                  exam.lulus
                                    ? "text-green-600"
                                    : "text-red-500"
                                }`}
                              >
                                {exam.nilai}
                              </span>
                            </td>
                            <td className="p-3 text-center text-gray-600">
                              {exam.jumlah_benar}/{exam.jumlah_soal}
                            </td>
                            <td className="p-3 text-center">
                              <span
                                className={`px-2.5 py-1 rounded-lg text-xs font-semibold ${
                                  exam.lulus
                                    ? "bg-green-100 text-green-700"
                                    : "bg-red-100 text-red-700"
                                }`}
                              >
                                {exam.lulus ? "Lulus" : "Tidak Lulus"}
                              </span>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              )}
            </div>
          ))
        )}
      </div>
    </div>
  );
};

export default ProgressDetailPage;
