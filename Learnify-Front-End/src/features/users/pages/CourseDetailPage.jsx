import React, { useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { useCourseDetail } from "../hooks/useCourseDetail";
import { STORAGE_URL } from "@/services/api/axios";
import Loading from "@/components/Loading";
import CardHeader from "../components/CardHeader";
import NotFound from "@/features/error/notfound";
import { toast } from "react-hot-toast";
import { kelasApi } from "@/services/api/kelas.api";
import { useAuth } from "@/hooks/useAuth";
import { saveIntendedDestination } from "@/utils/redirect";
import { getCourseImageUrl } from "../utils/courseImage";
import {
  BookOpen,
  Clock,
  Lock,
  CheckCircle,
  ArrowRight,
  Play,
} from "lucide-react";
import Button from "@/components/button";

const CourseDetailPage = () => {
  const { kelasId } = useParams();
  const navigate = useNavigate();
  const { isAuthenticated } = useAuth();
  const { course, loading, error, refetch } = useCourseDetail(kelasId);
  const [starting, setStarting] = useState(false);

  const handleStartCourse = async () => {
    if (!isAuthenticated) {
      saveIntendedDestination(`/user/courses/${kelasId}/materials`, kelasId);
      toast("Silakan login terlebih dahulu untuk memulai kelas");
      navigate("/login");
      return;
    }

    setStarting(true);
    try {
      await kelasApi.startCourse(kelasId);
      toast.success("Berhasil memulai kelas!");
      navigate(`/user/courses/${kelasId}/materials`);
    } catch (err) {
      toast.error(err?.response?.data?.message || "Gagal memulai kelas");
    } finally {
      setStarting(false);
    }
  };

  const handleContinueCourse = () => {
    navigate(`/user/courses/${kelasId}/materials`);
  };

  if (loading) return <Loading />;

  if (error || !course) {
    return (
      <div className="p-6 max-w-5xl mx-auto">
        <NotFound
          title="Kelas Tidak Ditemukan"
          message={error || "Kelas yang Anda cari tidak tersedia."}
          type="notfound"
          onHome={() => navigate("/user/courses")}
        />
      </div>
    );
  }

  const materials = course.materials || [];
  const isEnrolled = course.isEnrolled;
  const courseStatus = course.status;

  return (
    <div className="p-6 max-w-5xl mx-auto">
      <CardHeader
        title={course.nama}
        subtitle="Detail Kursus"
        showBack
        onBack={() => navigate("/user/courses")}
      />

      {/* Course Hero */}
      <div className="mt-6 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200">
        <div className="h-48 sm:h-64 bg-gray-100 overflow-hidden">
          <img
            src={getCourseImageUrl(course.thumnail, STORAGE_URL)}
            alt={course.nama}
            className="w-full h-full object-cover"
          />
        </div>

        <div className="p-6">
          <h1 className="text-2xl font-bold text-gray-900">{course.nama}</h1>

          <div className="flex items-center gap-6 mt-4 text-sm text-gray-500">
            <span className="flex items-center gap-2">
              <BookOpen className="w-4 h-4" />
              {course.totalMaterials || materials.length} Materi
            </span>
            <span className="flex items-center gap-2">
              <Clock className="w-4 h-4" />
              {new Date(course.created_at).toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long",
                year: "numeric",
              })}
            </span>
          </div>

          {isEnrolled && courseStatus === "completed" ? (
            <div className="mt-6 p-4 bg-green-50 rounded-xl border border-green-200">
              <div className="flex items-center gap-2 text-green-700 font-semibold">
                <CheckCircle className="w-5 h-5" />
                Kursus Selesai
              </div>
              <p className="text-green-600 text-sm mt-1">
                Anda telah menyelesaikan seluruh materi dan ujian.
              </p>
            </div>
          ) : isEnrolled ? (
            <div className="mt-6 flex gap-3">
              <Button
                onClick={handleContinueCourse}
                variant="primary"
                className="flex items-center gap-2"
              >
                Lanjutkan Belajar
                <ArrowRight className="w-4 h-4" />
              </Button>
            </div>
          ) : (
            <div className="mt-6">
              <Button
                onClick={handleStartCourse}
                variant="primary"
                loading={starting}
                className="flex items-center gap-2"
              >
                <Play className="w-4 h-4" />
                Mulai Course
              </Button>
            </div>
          )}
        </div>
      </div>

      {/* Material List */}
      <div className="mt-8">
        <h2 className="text-xl font-bold text-gray-900 mb-4">
          Daftar Materi ({materials.length})
        </h2>

        {materials.length === 0 ? (
          <p className="text-gray-500">Belum ada materi untuk kursus ini.</p>
        ) : (
          <div className="space-y-3">
            {materials.map((m, index) => (
              <div
                key={m.id}
                className="bg-white border border-gray-200 rounded-xl p-4 flex items-center gap-4"
              >
                <div className="shrink-0 w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-gray-600">
                  {index + 1}
                </div>
                <div className="flex-1">
                  <h3 className="font-semibold text-gray-900">{m.judul}</h3>
                  {m.deskripsi && (
                    <p className="text-sm text-gray-500 line-clamp-1">
                      {m.deskripsi}
                    </p>
                  )}
                </div>
                {!isEnrolled && (
                  <Lock className="w-5 h-5 text-gray-400 shrink-0" />
                )}
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
};

export default CourseDetailPage;
