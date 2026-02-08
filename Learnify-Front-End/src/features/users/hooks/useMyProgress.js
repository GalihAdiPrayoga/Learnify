import { useState, useEffect, useCallback, useRef } from "react";
import axiosInstance from "@/services/api/axios";

/**
 * Hook to fetch only enrolled courses (my progress)
 * Uses endpoint: GET /kelas/my-courses
 */
export const useMyProgress = () => {
  const [courses, setCourses] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const isMountedRef = useRef(true);
  useEffect(() => {
    isMountedRef.current = true;
    return () => {
      isMountedRef.current = false;
    };
  }, []);

  const pendingRef = useRef(false);
  const lastCoursesJsonRef = useRef(null);
  const lastErrorRef = useRef(null);

  const fetchMyCourses = useCallback(async () => {
    if (!isMountedRef.current) return;
    if (pendingRef.current) return;
    pendingRef.current = true;
    setLoading(true);
    try {
      // Fetch only enrolled courses
      const res = await axiosInstance.get("/kelas/my-courses");
      const data = res?.data?.data || [];
      const newJson = JSON.stringify(data);
      if (isMountedRef.current) {
        if (lastCoursesJsonRef.current !== newJson) {
          setCourses(data);
          lastCoursesJsonRef.current = newJson;
        }
        lastErrorRef.current = null;
        setError(null);
      }
    } catch (err) {
      if (isMountedRef.current) {
        const message = err?.response?.data?.message || "Gagal memuat progress";
        if (lastErrorRef.current !== message) {
          setError(message);
          lastErrorRef.current = message;
        }
        setCourses([]);
        lastCoursesJsonRef.current = JSON.stringify([]);
      }
    } finally {
      if (isMountedRef.current) setLoading(false);
      pendingRef.current = false;
    }
  }, []);

  useEffect(() => {
    fetchMyCourses();
  }, [fetchMyCourses]);

  return {
    courses,
    loading,
    error,
    refetch: fetchMyCourses,
  };
};
