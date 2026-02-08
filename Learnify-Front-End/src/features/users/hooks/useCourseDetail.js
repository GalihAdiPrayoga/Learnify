import { useState, useEffect, useRef, useCallback } from "react";
import axiosInstance from "@/services/api/axios";
import { useAuth } from "@/hooks/useAuth";

export const useCourseDetail = (kelasId) => {
  const [course, setCourse] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const isMountedRef = useRef(true);
  const { isAuthenticated } = useAuth();

  const fetchCourse = useCallback(async () => {
    if (!kelasId) return;
    setLoading(true);
    try {
      const endpoint = isAuthenticated
        ? `/user/kelas`
        : `/kelas/public/${kelasId}`;

      const res = await axiosInstance.get(endpoint);
      if (!isMountedRef.current) return;

      if (isAuthenticated) {
        // Find the specific course from the list
        const courses = res?.data?.data ?? res?.data ?? [];
        const found = courses.find((c) => c.id === Number(kelasId));
        setCourse(found || null);
      } else {
        setCourse(res?.data?.data ?? res?.data ?? null);
      }
    } catch (err) {
      if (isMountedRef.current) {
        setError(err?.response?.data?.message || "Gagal memuat detail kelas");
      }
    } finally {
      if (isMountedRef.current) setLoading(false);
    }
  }, [kelasId, isAuthenticated]);

  useEffect(() => {
    isMountedRef.current = true;
    fetchCourse();
    return () => {
      isMountedRef.current = false;
    };
  }, [fetchCourse]);

  return { course, loading, error, refetch: fetchCourse };
};
