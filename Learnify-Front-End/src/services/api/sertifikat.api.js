import axiosInstance from "./axios";

export const sertifikatApi = {
  getAll: async () => {
    const response = await axiosInstance.get("/user/sertifikat");
    return response.data;
  },

  getById: async (id) => {
    const response = await axiosInstance.get(`/user/sertifikat/${id}`);
    return response.data;
  },

  adminGetAll: async () => {
    const response = await axiosInstance.get("/admin/sertifikat");
    return response.data;
  },
};
