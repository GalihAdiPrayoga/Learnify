import React, { useState, useMemo } from "react";
import { useNavigate } from "react-router-dom";
import { useAdminProgress } from "../hooks/useAdminProgress";
import Loading from "@/components/Loading";
import HeaderCard from "../components/HeaderCard";
import SearchBar from "../components/SearchBar";
import Pagination from "../components/Pagination";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";
import {
  Users,
  BookOpen,
  Award,
  TrendingUp,
  Eye,
  Download,
  BarChart3,
  CheckCircle,
} from "lucide-react";

const ProgressPage = () => {
  const navigate = useNavigate();
  const { users, loading, error } = useAdminProgress();
  const [searchTerm, setSearchTerm] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 10;

  const filtered = useMemo(() => {
    if (!searchTerm.trim()) return users;
    const q = searchTerm.toLowerCase();
    return users.filter(
      (u) =>
        u.name?.toLowerCase().includes(q) ||
        u.email?.toLowerCase().includes(q),
    );
  }, [users, searchTerm]);

  const totalPages = Math.ceil(filtered.length / itemsPerPage);
  const paginated = filtered.slice(
    (currentPage - 1) * itemsPerPage,
    currentPage * itemsPerPage,
  );

  // Summary stats
  const totalEnrolled = users.reduce(
    (sum, u) => sum + (u.enrolled_courses || 0),
    0,
  );
  const totalCompleted = users.reduce(
    (sum, u) => sum + (u.completed_courses || 0),
    0,
  );
  const totalCerts = users.reduce(
    (sum, u) => sum + (u.certificates_count || 0),
    0,
  );
  const avgProgress =
    users.length > 0
      ? Math.round(
          users.reduce((sum, u) => sum + (u.avg_progress || 0), 0) /
            users.length,
        )
      : 0;

  if (loading) return <Loading />;

  const handleExportPDF = () => {
    const doc = new jsPDF();
    doc.setFontSize(16);
    doc.text("Laporan Progres Pengguna", 14, 20);
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text(`Dicetak pada: ${new Date().toLocaleDateString("id-ID", { day: "numeric", month: "long", year: "numeric" })}`, 14, 28);
    doc.text(`Total Pengguna: ${users.length} | Rata-rata Progres: ${avgProgress}%`, 14, 34);

    autoTable(doc, {
      startY: 42,
      head: [["No", "Nama", "Email", "Kursus", "Progres", "Selesai", "Sertifikat"]],
      body: filtered.map((user, idx) => [
        idx + 1,
        user.name,
        user.email,
        user.enrolled_courses,
        `${user.avg_progress}%`,
        user.completed_courses,
        user.certificates_count,
      ]),
      styles: { fontSize: 9 },
      headStyles: { fillColor: [79, 70, 229] },
    });

    doc.save("laporan-progres-pengguna.pdf");
  };

  return (
    <div className="p-6">
      <HeaderCard
        title="Laporan Progres Pengguna"
        subtitle="Pantau kemajuan belajar seluruh pengguna"
      />

      {error ? (
        <div className="mt-6 text-center text-red-500">{error}</div>
      ) : (
        <>
          {/* Stats Overview */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 print:hidden">
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4 hover:shadow-md transition">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <Users className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Total Pengguna
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {users.length}
                </p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4 hover:shadow-md transition">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <BookOpen className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Total Pendaftaran
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {totalEnrolled}
                </p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4 hover:shadow-md transition">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <CheckCircle className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Kursus Diselesaikan
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {totalCompleted}
                </p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4 hover:shadow-md transition">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                <BarChart3 className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Rata-rata Progres
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {avgProgress}%
                </p>
              </div>
            </div>
          </div>

          {/* Toolbar */}
          <div className="mt-6 flex flex-col sm:flex-row items-center gap-3 print:hidden">
            <div className="flex-1 w-full">
              <SearchBar
                onSearch={(val) => {
                  setSearchTerm(val);
                  setCurrentPage(1);
                }}
                placeholder="Cari nama atau email pengguna..."
              />
            </div>
            <button
              onClick={handleExportPDF}
              className="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-medium text-sm shrink-0"
            >
              <Download className="w-4 h-4" />
              Cetak Laporan
            </button>
          </div>

          {/* Table */}
          <div className="mt-4 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full text-sm">
                <thead>
                  <tr className="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <th className="text-left p-4 font-semibold text-gray-700 w-12">
                      No
                    </th>
                    <th className="text-left p-4 font-semibold text-gray-700">
                      Pengguna
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Kursus
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Progres
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Selesai
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Sertifikat
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Aksi
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {paginated.length === 0 ? (
                    <tr>
                      <td
                        colSpan="7"
                        className="p-8 text-center text-gray-500"
                      >
                        {searchTerm
                          ? "Tidak ada pengguna ditemukan."
                          : "Belum ada data pengguna."}
                      </td>
                    </tr>
                  ) : (
                    paginated.map((user, idx) => (
                      <tr
                        key={user.id}
                        className="border-b border-gray-100 hover:bg-indigo-50/30 transition cursor-pointer"
                        onClick={() => navigate(`/admin/progress/${user.id}`)}
                      >
                        <td className="p-4 text-gray-500 font-medium">
                          {(currentPage - 1) * itemsPerPage + idx + 1}
                        </td>
                        <td className="p-4">
                          <div className="flex items-center gap-3">
                            <div className="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                              {user.name
                                ?.split(" ")
                                .map((n) => n[0])
                                .join("")
                                .substring(0, 2)
                                .toUpperCase() || "?"}
                            </div>
                            <div>
                              <p className="font-semibold text-gray-900">
                                {user.name}
                              </p>
                              <p className="text-xs text-gray-500">
                                {user.email}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td className="p-4 text-center">
                          <span className="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium">
                            <BookOpen className="w-3 h-3" />
                            {user.enrolled_courses}
                          </span>
                        </td>
                        <td className="p-4 text-center">
                          <div className="flex items-center justify-center gap-2">
                            <div className="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                              <div
                                className={`h-full rounded-full transition-all ${
                                  user.avg_progress >= 80
                                    ? "bg-emerald-500"
                                    : user.avg_progress >= 50
                                      ? "bg-indigo-500"
                                      : "bg-amber-500"
                                }`}
                                style={{ width: `${user.avg_progress}%` }}
                              />
                            </div>
                            <span className="text-xs font-semibold text-gray-700 w-10">
                              {user.avg_progress}%
                            </span>
                          </div>
                        </td>
                        <td className="p-4 text-center">
                          <span className="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-700 rounded-lg text-xs font-medium">
                            <CheckCircle className="w-3 h-3" />
                            {user.completed_courses}
                          </span>
                        </td>
                        <td className="p-4 text-center">
                          <span className="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-700 rounded-lg text-xs font-medium">
                            <Award className="w-3 h-3" />
                            {user.certificates_count}
                          </span>
                        </td>
                        <td className="p-4 text-center">
                          <button
                            onClick={(e) => {
                              e.stopPropagation();
                              navigate(`/admin/progress/${user.id}`);
                            }}
                            className="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg text-xs font-semibold transition"
                          >
                            <Eye className="w-3.5 h-3.5" />
                            Detail
                          </button>
                        </td>
                      </tr>
                    ))
                  )}
                </tbody>
              </table>
            </div>
          </div>

          {/* Pagination */}
          {totalPages > 1 && (
            <div className="mt-4 print:hidden">
              <Pagination
                currentPage={currentPage}
                totalPages={totalPages}
                onPageChange={setCurrentPage}
                totalItems={filtered.length}
                itemsPerPage={itemsPerPage}
              />
            </div>
          )}
        </>
      )}
    </div>
  );
};

export default ProgressPage;
