import { useState, useEffect, useRef, useCallback } from "react";
import { adminProgressApi } from "@/services/api/adminProgress.api";

export const useAdminProgress = () => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const isMountedRef = useRef(true);

  const fetchUsers = useCallback(async () => {
    setLoading(true);
    try {
      const res = await adminProgressApi.getAll();
      if (isMountedRef.current) {
        setUsers(res?.data ?? []);
      }
    } catch (err) {
      if (isMountedRef.current) {
        setError(err?.response?.data?.message || "Gagal memuat data progress");
      }
    } finally {
      if (isMountedRef.current) setLoading(false);
    }
  }, []);

  useEffect(() => {
    isMountedRef.current = true;
    fetchUsers();
    return () => {
      isMountedRef.current = false;
    };
  }, [fetchUsers]);

  return { users, loading, error, refetch: fetchUsers };
};

export const useAdminProgressDetail = (userId) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (!userId) {
      setLoading(false);
      return;
    }
    const fetch = async () => {
      setLoading(true);
      try {
        const res = await adminProgressApi.getByUser(userId);
        setData(res?.data ?? null);
      } catch (err) {
        setError(err?.response?.data?.message || "Gagal memuat data");
      } finally {
        setLoading(false);
      }
    };
    fetch();
  }, [userId]);

  return { data, loading, error };
};
