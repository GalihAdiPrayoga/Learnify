import React, { useState, useMemo } from "react";
import { useAdminCertificate } from "../hooks/useAdminCertificate";
import Loading from "@/components/Loading";
import HeaderCard from "../components/HeaderCard";
import SearchBar from "../components/SearchBar";
import Pagination from "../components/Pagination";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";
import {
  Award,
  Calendar,
  User,
  BookOpen,
  Hash,
  Download,
} from "lucide-react";

const SertifikatPage = () => {
  const { certificates, loading, error } = useAdminCertificate();
  const [searchTerm, setSearchTerm] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 10;

  const filtered = useMemo(() => {
    if (!searchTerm.trim()) return certificates;
    const q = searchTerm.toLowerCase();
    return certificates.filter(
      (c) =>
        c.user?.name?.toLowerCase().includes(q) ||
        c.kelas?.nama?.toLowerCase().includes(q) ||
        c.nomor_sertifikat?.toLowerCase().includes(q),
    );
  }, [certificates, searchTerm]);

  const totalPages = Math.ceil(filtered.length / itemsPerPage);
  const paginated = filtered.slice(
    (currentPage - 1) * itemsPerPage,
    currentPage * itemsPerPage,
  );

  const handleExportPDF = () => {
    const doc = new jsPDF();
    doc.setFontSize(16);
    doc.text("Laporan Sertifikat", 14, 20);
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text(`Dicetak pada: ${new Date().toLocaleDateString("id-ID", { day: "numeric", month: "long", year: "numeric" })}`, 14, 28);
    doc.text(`Total: ${certificates.length} sertifikat | ${new Set(certificates.map((c) => c.user_id)).size} penerima unik`, 14, 34);

    autoTable(doc, {
      startY: 42,
      head: [["No", "Penerima", "Email", "Kursus", "Nomor Sertifikat", "Tanggal Terbit"]],
      body: filtered.map((cert, idx) => [
        idx + 1,
        cert.user?.name || "-",
        cert.user?.email || "-",
        cert.kelas?.nama || "-",
        cert.nomor_sertifikat,
        new Date(cert.tanggal_terbit).toLocaleDateString("id-ID", { day: "numeric", month: "short", year: "numeric" }),
      ]),
      styles: { fontSize: 8 },
      headStyles: { fillColor: [79, 70, 229] },
    });

    doc.save("laporan-sertifikat.pdf");
  };

  if (loading) return <Loading />;

  return (
    <div className="p-6">
      <HeaderCard
        title="Manajemen Sertifikat"
        subtitle={`Total ${certificates.length} sertifikat yang telah diterbitkan`}
      />

      {error ? (
        <div className="mt-6 text-center text-red-500">{error}</div>
      ) : (
        <>
          {/* Stats Cards */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 print:hidden">
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-orange-500/20">
                <Award className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Total Sertifikat
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {certificates.length}
                </p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <User className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Penerima Unik
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {new Set(certificates.map((c) => c.user_id)).size}
                </p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <BookOpen className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Kursus Bersertifikat
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {new Set(certificates.map((c) => c.kelas_id)).size}
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
                placeholder="Cari nama, kelas, atau nomor sertifikat..."
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
                      Penerima
                    </th>
                    <th className="text-left p-4 font-semibold text-gray-700">
                      Kursus
                    </th>
                    <th className="text-left p-4 font-semibold text-gray-700">
                      Nomor Sertifikat
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Tanggal Terbit
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {paginated.length === 0 ? (
                    <tr>
                      <td colSpan="5" className="p-8 text-center text-gray-500">
                        {searchTerm
                          ? "Tidak ada sertifikat ditemukan."
                          : "Belum ada sertifikat yang diterbitkan."}
                      </td>
                    </tr>
                  ) : (
                    paginated.map((cert, idx) => (
                      <tr
                        key={cert.id}
                        className="border-b border-gray-100 hover:bg-indigo-50/30 transition"
                      >
                        <td className="p-4 text-gray-500 font-medium">
                          {(currentPage - 1) * itemsPerPage + idx + 1}
                        </td>
                        <td className="p-4">
                          <div className="flex items-center gap-3">
                            <div className="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                              {cert.user?.name
                                ?.split(" ")
                                .map((n) => n[0])
                                .join("")
                                .substring(0, 2)
                                .toUpperCase() || "?"}
                            </div>
                            <div>
                              <p className="font-semibold text-gray-900">
                                {cert.user?.name || "-"}
                              </p>
                              <p className="text-xs text-gray-500">
                                {cert.user?.email || ""}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td className="p-4">
                          <span className="inline-flex items-center gap-1.5 px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-medium">
                            <BookOpen className="w-3 h-3" />
                            {cert.kelas?.nama || "-"}
                          </span>
                        </td>
                        <td className="p-4">
                          <div className="flex items-center gap-1.5 text-gray-600 font-mono text-xs">
                            <Hash className="w-3 h-3 text-gray-400" />
                            {cert.nomor_sertifikat}
                          </div>
                        </td>
                        <td className="p-4 text-center">
                          <div className="flex items-center justify-center gap-1.5 text-gray-600 text-xs">
                            <Calendar className="w-3 h-3 text-gray-400" />
                            {new Date(cert.tanggal_terbit).toLocaleDateString(
                              "id-ID",
                              {
                                day: "numeric",
                                month: "short",
                                year: "numeric",
                              },
                            )}
                          </div>
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

export default SertifikatPage;
