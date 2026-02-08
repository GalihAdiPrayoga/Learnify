import React from "react";
import { useNavigate } from "react-router-dom";
import { useCertificate } from "../hooks/useCertificate";
import Loading from "@/components/Loading";
import CardHeader from "../components/CardHeader";
import NotFound from "@/features/error/notfound";
import { Award, Calendar, ArrowRight, Hash, Eye } from "lucide-react";

const CertificatePage = () => {
  const navigate = useNavigate();
  const { certificates, loading, error } = useCertificate();

  if (loading) return <Loading />;

  return (
    <div className="p-6 max-w-5xl mx-auto">
      <CardHeader
        title="Sertifikat Saya"
        subtitle="Daftar sertifikat yang telah Anda peroleh"
        showBack
        onBack={() => navigate("/user/dashboard")}
      />

      {error ? (
        <NotFound
          title="Gagal Memuat Data"
          message={error}
          type="error"
          onRetry={() => window.location.reload()}
        />
      ) : certificates.length === 0 ? (
        <NotFound
          title="Belum Ada Sertifikat"
          message="Selesaikan kursus untuk mendapatkan sertifikat penyelesaian."
          type="notfound"
          onHome={() => navigate("/user/courses")}
        />
      ) : (
        <>
          {/* Summary */}
          <div className="mt-6 bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-200/50 rounded-2xl p-5 flex items-center gap-4">
            <div className="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-orange-500/20 shrink-0">
              <Award className="w-7 h-7 text-white" />
            </div>
            <div>
              <p className="text-amber-800 font-bold text-lg">
                {certificates.length} Sertifikat Diperoleh
              </p>
              <p className="text-amber-700/70 text-sm">
                Selamat! Anda telah menyelesaikan{" "}
                {certificates.length} kursus.
              </p>
            </div>
          </div>

          {/* Certificate Cards */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
            {certificates.map((cert) => (
              <div
                key={cert.id}
                onClick={() => navigate(`/user/certificates/${cert.id}`)}
                className="bg-white rounded-2xl overflow-hidden cursor-pointer hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 group border border-gray-200 hover:border-indigo-300"
              >
                {/* Mini certificate preview header */}
                <div className="bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-3 flex items-center justify-between">
                  <div className="flex items-center gap-2">
                    <div className="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center">
                      <Award className="w-4 h-4 text-yellow-300" />
                    </div>
                    <span className="text-white/90 text-xs font-semibold tracking-wider uppercase">
                      Sertifikat
                    </span>
                  </div>
                  <div className="flex items-center gap-1 text-white/60 text-xs">
                    <Hash className="w-3 h-3" />
                    <span className="font-mono">
                      {cert.nomor_sertifikat}
                    </span>
                  </div>
                </div>

                {/* Card body */}
                <div className="p-5">
                  <h3 className="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition">
                    {cert.kelas?.nama || "Kursus"}
                  </h3>

                  <div className="flex items-center gap-2 mt-3 text-sm text-gray-500">
                    <Calendar className="w-4 h-4 shrink-0" />
                    <span>
                      {new Date(cert.tanggal_terbit).toLocaleDateString(
                        "id-ID",
                        {
                          day: "numeric",
                          month: "long",
                          year: "numeric",
                        },
                      )}
                    </span>
                  </div>

                  <div className="mt-4 flex items-center justify-between">
                    <div className="flex items-center gap-1.5 text-indigo-600 text-sm font-semibold group-hover:gap-2.5 transition-all">
                      <Eye className="w-4 h-4" />
                      Lihat Sertifikat
                    </div>
                    <ArrowRight className="w-4 h-4 text-gray-400 group-hover:text-indigo-500 group-hover:translate-x-1 transition-all" />
                  </div>
                </div>
              </div>
            ))}
          </div>
        </>
      )}
    </div>
  );
};

export default CertificatePage;
