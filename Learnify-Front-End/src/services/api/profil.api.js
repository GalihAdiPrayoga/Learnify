import axiosInstance from "./axios";

export const profilApi = {
  getAll: async () => {
    const response = await axiosInstance.get("/profil");
    return response.data;
  },

  getById: async (id) => {
    const response = await axiosInstance.get(`/profil/${id}`);
    return response.data;
  },

  create: async (userData) => {
    const formData = new FormData();
    if (userData.name) formData.append("name", userData.name);
    if (userData.username) formData.append("username", userData.username);
    if (userData.email) formData.append("email", userData.email);
    if (userData.password) formData.append("password", userData.password);
    if (userData.role) formData.append("role", userData.role);
    if (userData.profile instanceof File) {
      formData.append("profile", userData.profile);
    }

    const response = await axiosInstance.post("/profil", formData, {
      headers: { "Content-Type": "multipart/form-data" },
    });
    return response.data;
  },

  update: async (id, userData) => {
    const formData = new FormData();
    if (userData.name) formData.append("name", userData.name);
    if (userData.username) formData.append("username", userData.username);
    if (userData.email) formData.append("email", userData.email);
    if (userData.password) formData.append("password", userData.password);
    if (userData.role) formData.append("role", userData.role);
    if (userData.profile instanceof File) {
      formData.append("profile", userData.profile);
    }
    formData.append("_method", "PUT");

    const response = await axiosInstance.post(`/profil/${id}`, formData, {
      headers: { "Content-Type": "multipart/form-data" },
    });
    return response.data;
  },

  delete: async (id) => {
    const response = await axiosInstance.delete(`/profil/${id}`);
    return response.data;
  },
};
