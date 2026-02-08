import React from "react";
import { useParams, useNavigate } from "react-router-dom";
import { useCertificateDetail } from "../hooks/useCertificate";
import Loading from "@/components/Loading";
import { Printer, ArrowLeft } from "lucide-react";

const CertificateDetailPage = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const { certificate, loading } = useCertificateDetail(id);

  if (loading) return <Loading />;
  if (!certificate) {
    return (
      <div className="p-6">
        <p className="text-center text-gray-500">
          Sertifikat tidak ditemukan.
        </p>
      </div>
    );
  }

  const handlePrint = () => {
    window.print();
  };

  const issueDateFormatted = new Date(
    certificate.tanggal_terbit,
  ).toLocaleDateString("id-ID", {
    day: "numeric",
    month: "long",
    year: "numeric",
  });

  return (
    <div className="p-6">
      {/* Print styles */}
      <style>
        {`
          @media print {
            body * { visibility: hidden !important; }
            .certificate-wrapper, .certificate-wrapper * { visibility: visible !important; }
            .certificate-wrapper {
              position: fixed !important;
              top: 0 !important;
              left: 0 !important;
              width: 100vw !important;
              height: 100vh !important;
              margin: 0 !important;
              padding: 0 !important;
              display: flex !important;
              align-items: center !important;
              justify-content: center !important;
            }
            .certificate-card {
              width: 297mm !important;
              height: 210mm !important;
              max-width: 297mm !important;
              box-shadow: none !important;
              border-radius: 0 !important;
            }
            @page {
              size: A4 landscape;
              margin: 0;
            }
          }
        `}
      </style>

      {/* Simple Back Button + Print */}
      <div className="print:hidden flex items-center justify-between mb-6">
        <button
          onClick={() => navigate("/user/certificates")}
          className="flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition group"
        >
          <ArrowLeft className="w-5 h-5 group-hover:-translate-x-1 transition-transform" />
          <span className="text-sm font-medium">Kembali</span>
        </button>
        <button
          onClick={handlePrint}
          className="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-semibold text-sm shadow-lg shadow-indigo-500/25"
        >
          <Printer className="w-4 h-4" />
          Cetak Sertifikat
        </button>
      </div>

      {/* Certificate */}
      <div className="certificate-wrapper flex justify-center">
        <div className="certificate-card bg-white relative overflow-hidden shadow-2xl rounded-lg w-full max-w-4xl"
          style={{ aspectRatio: "1.414 / 1" }}
        >
          {/* Outer decorative border */}
          <div className="absolute inset-3 border-2 border-amber-600/30 rounded pointer-events-none" />
          <div className="absolute inset-5 border border-amber-600/20 rounded pointer-events-none" />

          {/* Corner ornaments */}
          <svg className="absolute top-3 left-3 w-16 h-16 text-amber-600/40" viewBox="0 0 64 64">
            <path d="M0 0 L64 0 L64 8 L8 8 L8 64 L0 64 Z" fill="currentColor" />
            <path d="M16 0 L16 4 L4 4 L4 16 L0 16 L0 0 Z" fill="currentColor" opacity="0.5" />
          </svg>
          <svg className="absolute top-3 right-3 w-16 h-16 text-amber-600/40 rotate-90" viewBox="0 0 64 64">
            <path d="M0 0 L64 0 L64 8 L8 8 L8 64 L0 64 Z" fill="currentColor" />
            <path d="M16 0 L16 4 L4 4 L4 16 L0 16 L0 0 Z" fill="currentColor" opacity="0.5" />
          </svg>
          <svg className="absolute bottom-3 left-3 w-16 h-16 text-amber-600/40 -rotate-90" viewBox="0 0 64 64">
            <path d="M0 0 L64 0 L64 8 L8 8 L8 64 L0 64 Z" fill="currentColor" />
            <path d="M16 0 L16 4 L4 4 L4 16 L0 16 L0 0 Z" fill="currentColor" opacity="0.5" />
          </svg>
          <svg className="absolute bottom-3 right-3 w-16 h-16 text-amber-600/40 rotate-180" viewBox="0 0 64 64">
            <path d="M0 0 L64 0 L64 8 L8 8 L8 64 L0 64 Z" fill="currentColor" />
            <path d="M16 0 L16 4 L4 4 L4 16 L0 16 L0 0 Z" fill="currentColor" opacity="0.5" />
          </svg>

          {/* Top decorative ribbon */}
          <div className="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-500" />

          {/* Content */}
          <div className="relative z-10 flex flex-col items-center justify-center h-full px-12 py-10 text-center">
            {/* Logo & Platform Name */}
            <div className="flex items-center gap-3 mb-2">
              <div className="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center shadow-md">
                <svg className="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                  <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                  <path d="M6 12v5c0 2 4 3 6 3s6-1 6-3v-5" />
                </svg>
              </div>
              <span className="text-lg font-bold text-indigo-700 tracking-wide">
                LEARNIFY
              </span>
            </div>

            {/* Title */}
            <h1
              className="text-4xl md:text-5xl font-bold tracking-[0.2em] text-gray-800 mt-4"
              style={{ fontFamily: "Georgia, 'Times New Roman', serif" }}
            >
              SERTIFIKAT
            </h1>

            {/* Decorative line */}
            <div className="flex items-center gap-3 mt-3 mb-6 w-72">
              <div className="flex-1 h-px bg-gradient-to-r from-transparent to-amber-500" />
              <svg className="w-5 h-5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2l2.5 5.5L18 8.5l-4 4 1 5.5L10 15.5 5 18l1-5.5-4-4 5.5-1z" />
              </svg>
              <div className="flex-1 h-px bg-gradient-to-l from-transparent to-amber-500" />
            </div>

            <p
              className="text-gray-500 text-base tracking-wide"
              style={{ fontFamily: "Georgia, 'Times New Roman', serif" }}
            >
              Dengan bangga diberikan kepada
            </p>

            {/* Recipient Name */}
            <h2
              className="text-3xl md:text-4xl font-bold text-indigo-800 mt-3 mb-1"
              style={{
                fontFamily: "Georgia, 'Times New Roman', serif",
                textDecoration: "none",
              }}
            >
              {certificate.user?.name || "-"}
            </h2>

            {/* Underline for name */}
            <div className="w-64 h-px bg-gradient-to-r from-transparent via-gray-400 to-transparent mb-5" />

            <p
              className="text-gray-600 text-base max-w-lg leading-relaxed"
              style={{ fontFamily: "Georgia, 'Times New Roman', serif" }}
            >
              Atas keberhasilan menyelesaikan seluruh materi dan ujian pada
              kursus
            </p>

            {/* Course Name */}
            <h3
              className="text-xl md:text-2xl font-bold text-amber-700 mt-2 mb-6"
              style={{ fontFamily: "Georgia, 'Times New Roman', serif" }}
            >
              &ldquo;{certificate.kelas?.nama || "-"}&rdquo;
            </h3>

            {/* Date & Certificate Number */}
            <p className="text-sm text-gray-500 mb-8">
              Diterbitkan pada{" "}
              <span className="font-semibold text-gray-700">
                {issueDateFormatted}
              </span>
            </p>

            {/* Signature Section */}
            <div className="flex items-end justify-center gap-16 mt-auto w-full max-w-2xl">
              {/* Left: Certificate ID */}
              <div className="text-center flex-1">
                <p className="text-[11px] font-mono text-gray-400 tracking-wide mb-2">
                  {certificate.nomor_sertifikat}
                </p>
                <div className="border-t border-gray-300 pt-2">
                  <p className="text-xs text-gray-500 font-medium">
                    Nomor Sertifikat
                  </p>
                </div>
              </div>

              {/* Center: Seal */}
              <div className="flex flex-col items-center mx-4">
                <div className="w-20 h-20 rounded-full border-2 border-amber-500/50 flex items-center justify-center bg-gradient-to-br from-amber-50 to-yellow-50">
                  <div className="w-16 h-16 rounded-full border border-amber-400/40 flex items-center justify-center">
                    <div className="text-center">
                      <svg className="w-6 h-6 text-amber-600 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                        <path d="M6 12v5c0 2 4 3 6 3s6-1 6-3v-5" />
                      </svg>
                      <p className="text-[7px] font-bold text-amber-700 mt-0.5 tracking-wider">
                        VERIFIED
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              {/* Right: Signature */}
              <div className="text-center flex-1">
                <svg
                  className="mx-auto mb-1 h-10"
                  viewBox="0 0 200 50"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M10 40 C30 10, 50 35, 70 20 S100 40, 120 15 S150 35, 170 25 Q180 20, 190 30"
                    stroke="#1e293b"
                    strokeWidth="2"
                    fill="none"
                    strokeLinecap="round"
                  />
                  <path
                    d="M30 35 Q40 42, 55 38"
                    stroke="#1e293b"
                    strokeWidth="1.5"
                    fill="none"
                    strokeLinecap="round"
                  />
                </svg>
                <div className="border-t border-gray-300 pt-2">
                  <p className="text-sm font-semibold text-gray-800">
                    Tim Learnify
                  </p>
                  <p className="text-xs text-gray-500">Direktur Akademik</p>
                </div>
              </div>
            </div>
          </div>

          {/* Bottom decorative ribbon */}
          <div className="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 via-yellow-400 to-amber-500" />
        </div>
      </div>
    </div>
  );
};

export default CertificateDetailPage;
