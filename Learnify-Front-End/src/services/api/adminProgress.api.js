import axiosInstance from "./axios";

export const adminProgressApi = {
  getAll: async () => {
    const response = await axiosInstance.get("/admin/progress");
    return response.data;
  },

  getByUser: async (userId) => {
    const response = await axiosInstance.get(`/admin/progress/${userId}`);
    return response.data;
  },
};
