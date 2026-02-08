import { useState, useEffect, useCallback, useRef } from "react";
import axiosInstance from "@/services/api/axios";
import { useAuth } from "@/hooks/useAuth";

export const useCourse = () => {
  const [courses, setCourses] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const { isAuthenticated } = useAuth();

  const isMountedRef = useRef(true);
  useEffect(() => {
    isMountedRef.current = true;
    return () => {
      isMountedRef.current = false;
    };
  }, []);

  // new refs to avoid loops / duplicate updates
  const pendingRef = useRef(false);
  const lastCoursesJsonRef = useRef(null);
  const lastErrorRef = useRef(null);

  const fetchCourses = useCallback(async () => {
    if (!isMountedRef.current) return;
    if (pendingRef.current) return;
    pendingRef.current = true;
    setLoading(true);
    try {
      // Use different endpoint based on authentication
      const endpoint = isAuthenticated ? "/user/kelas" : "/kelas/public";
      const res = await axiosInstance.get(endpoint);
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
        const message = err?.response?.data?.message || "Gagal memuat kelas";
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
  }, [isAuthenticated]);

  useEffect(() => {
    fetchCourses();
  }, [fetchCourses]);

  return {
    courses,
    loading,
    error,
    refetch: fetchCourses,
  };
};
