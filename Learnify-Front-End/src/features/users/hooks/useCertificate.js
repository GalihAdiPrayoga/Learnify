import { useState, useEffect, useRef, useCallback } from "react";
import { sertifikatApi } from "@/services/api/sertifikat.api";

export const useCertificate = () => {
  const [certificates, setCertificates] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const isMountedRef = useRef(true);

  const fetchCertificates = useCallback(async () => {
    setLoading(true);
    try {
      const res = await sertifikatApi.getAll();
      if (isMountedRef.current) {
        setCertificates(res?.data ?? []);
      }
    } catch (err) {
      if (isMountedRef.current) {
        setError(err?.response?.data?.message || "Gagal memuat sertifikat");
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

export const useCertificateDetail = (id) => {
  const [certificate, setCertificate] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!id) {
      setLoading(false);
      return;
    }
    const fetch = async () => {
      try {
        const res = await sertifikatApi.getById(id);
        setCertificate(res?.data ?? null);
      } catch {
        setCertificate(null);
      } finally {
        setLoading(false);
      }
    };
    fetch();
  }, [id]);

  return { certificate, loading };
};
