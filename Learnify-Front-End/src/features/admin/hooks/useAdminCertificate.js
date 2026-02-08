import { useState, useEffect, useRef, useCallback } from "react";
import { sertifikatApi } from "@/services/api/sertifikat.api";

export const useAdminCertificate = () => {
  const [certificates, setCertificates] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const isMountedRef = useRef(true);

  const fetchCertificates = useCallback(async () => {
    setLoading(true);
    try {
      const res = await sertifikatApi.adminGetAll();
      if (isMountedRef.current) {
        setCertificates(res?.data ?? []);
      }
    } catch (err) {
      if (isMountedRef.current) {
        setError(
          err?.response?.data?.message || "Gagal memuat data sertifikat",
        );
      }
    } finally {
      if (isMountedRef.current) setLoading(false);
    }
  }, []);

  useEffect(() => {
    isMountedRef.current = true;
    fetchCertificates();
    return () => {
      isMountedRef.current = false;
    };
  }, [fetchCertificates]);

  return { certificates, loading, error, refetch: fetchCertificates };
};
