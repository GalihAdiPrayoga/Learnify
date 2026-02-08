import { useState, useEffect } from "react";
import { profilApi } from "@/services/api/profil.api";

export const useAdminUsers = () => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const fetchUsers = async () => {
    setLoading(true);
    setError(null);
    try {
      const response = await profilApi.getAll();
      setUsers(response.data || []);
    } catch (err) {
      setError(err.response?.data?.message || "Gagal memuat data pengguna");
    } finally {
      setLoading(false);
    }
  };

  const createUser = async (userData) => {
    try {
      const response = await profilApi.create(userData);
      await fetchUsers();
      return response;
    } catch (err) {
      throw err;
    }
  };

  const updateUser = async (id, userData) => {
    try {
      const response = await profilApi.update(id, userData);
      await fetchUsers();
      return response;
    } catch (err) {
      throw err;
    }
  };

  const deleteUser = async (id) => {
    try {
      const response = await profilApi.delete(id);
      await fetchUsers();
      return response;
    } catch (err) {
      throw err;
    }
  };

  useEffect(() => {
    fetchUsers();
  }, []);

  return {
    users,
    loading,
    error,
    fetchUsers,
    createUser,
    updateUser,
    deleteUser,
  };
};
