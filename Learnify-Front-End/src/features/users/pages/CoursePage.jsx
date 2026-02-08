import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { useCourse } from "../hooks/useCourse";
import { STORAGE_URL } from "@/services/api/axios";
import Loading from "@/components/Loading";
import CardHeader from "../components/CardHeader";
import NotFound from "@/features/error/notfound";
import { toast } from "react-hot-toast";
import { kelasApi } from "@/services/api/kelas.api";
import CourseSearch from "../components/course/CourseSearch";
import CourseCard from "../components/course/CourseCard";
import { getCourseImageUrl } from "../utils/courseImage";
import { useAuth } from "@/hooks/useAuth";
import { saveIntendedDestination } from "@/utils/redirect";

const CoursePage = () => {
  const { courses, loading, error, refetch } = useCourse();
  const navigate = useNavigate();
  const { isAuthenticated } = useAuth();
  const [query, setQuery] = useState("");

  const displayedCourses =
    courses?.filter((c) =>
      String(c.nama || "")
        .toLowerCase()
        .includes(query.trim().toLowerCase()),
    ) || [];

  const handleViewMaterials = (courseId) => {
    // Check if user is authenticated
    if (!isAuthenticated) {
      // Save course materials path and redirect to login
      saveIntendedDestination(`/user/courses/${courseId}/materials`, courseId);
      toast.info("Silakan login terlebih dahulu untuk melihat materi");
      navigate("/login");
      return;
    }

    // Navigate to materials if authenticated
    navigate(`/user/courses/${courseId}/materials`);
  };

  const handleStartCourse = async (e, courseId) => {
    e.stopPropagation();

    // Check if user is authenticated
    if (!isAuthenticated) {
      // Save course ID and redirect to login
      saveIntendedDestination(`/user/courses/${courseId}/materials`, courseId);
      toast.info("Silakan login terlebih dahulu untuk memulai kelas");
      navigate("/login");
      return;
    }

    // Original logic for authenticated users
    try {
      await kelasApi.startCourse(courseId);
      toast.success("Kelas ditambahkan ke progress!");
      // Force refresh dengan delay untuk memastikan backend sudah update
      await new Promise((resolve) => setTimeout(resolve, 300));
      await refetch();
    } catch (err) {
      toast.error(err?.response?.data?.message || "Gagal memulai kelas");
    }
  };

  const handleCancelCourse = async (e, courseId) => {
    e.stopPropagation();
    try {
      await kelasApi.cancelCourse(courseId);
      toast.success("Kelas dibatalkan dari progress");
      await new Promise((resolve) => setTimeout(resolve, 300));
      await refetch();
    } catch (err) {
      toast.error(err?.response?.data?.message || "Gagal membatalkan kelas");
    }
  };

  const cardVariants = {
    hidden: { opacity: 0, y: 20 },
    visible: (i) => ({
      opacity: 1,
      y: 0,
      transition: {
        delay: i * 0.1,
        duration: 0.5,
        ease: "easeOut",
      },
    }),
  };

  if (loading) return <Loading />;

  return (
    <div className="p-6 max-w-7xl mx-auto">
      <CardHeader
        title="Kelas Saya"
        subtitle="Daftar kelas yang Anda ikuti"
        showBack={true}
        onBack={() => navigate(-1)}
      />

      {/* Search bar - always visible */}
      <CourseSearch
        value={query}
        onChange={setQuery}
        onClear={() => setQuery("")}
      />

      {error ? (
        <div className="mt-6">
          <NotFound
            title="Gagal Memuat Data"
            message={
              error ||
              "Terjadi kesalahan saat mengambil data kelas. Silakan coba lagi."
            }
            type="error"
            onRetry={() => refetch?.() || window.location.reload()}
          />
        </div>
      ) : displayedCourses.length === 0 ? (
        query ? (
          <NotFound
            title="Tidak ada hasil"
            message={`Tidak ada hasil untuk "${query}"`}
            type="notfound"
            onRetry={() => setQuery("")}
          />
        ) : (
          <NotFound
            title="Belum Ada Kelas"
            message="Anda belum terdaftar di kelas manapun."
            type="notfound"
            onHome={() => navigate("/user/landing")}
          />
        )
      ) : (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
          {displayedCourses.map((course, index) => (
            <CourseCard
              key={course.id}
              course={course}
              index={index}
              getImageUrl={(thumb) => getCourseImageUrl(thumb, STORAGE_URL)}
              onView={(id) => navigate(`/user/courses/${id}/materials`)}
              onStart={handleStartCourse}
              onCancel={handleCancelCourse}
            />
          ))}
        </div>
      )}
    </div>
  );
};

export default CoursePage;
