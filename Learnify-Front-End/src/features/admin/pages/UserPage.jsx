import React, { useState, useMemo } from "react";
import { useAdminUsers } from "../hooks/useAdminUsers";
import Loading from "@/components/Loading";
import HeaderCard from "../components/HeaderCard";
import SearchBar from "../components/SearchBar";
import Pagination from "../components/Pagination";
import Modal from "../components/Modal";
import toastr from "toastr";
import {
  Users,
  UserPlus,
  Shield,
  User,
  Mail,
  AtSign,
  Lock,
  Edit3,
  Trash2,
  Image,
  Eye,
  EyeOff,
} from "lucide-react";

const INITIAL_FORM = {
  name: "",
  username: "",
  email: "",
  password: "",
  role: "User",
  profile: null,
};

const UserPage = () => {
  const { users, loading, error, createUser, updateUser, deleteUser } =
    useAdminUsers();
  const [searchTerm, setSearchTerm] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage] = useState(10);

  // Modal state
  const [showModal, setShowModal] = useState(false);
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [editingUser, setEditingUser] = useState(null);
  const [deletingUser, setDeletingUser] = useState(null);
  const [formData, setFormData] = useState(INITIAL_FORM);
  const [formLoading, setFormLoading] = useState(false);
  const [showPassword, setShowPassword] = useState(false);
  const [previewImage, setPreviewImage] = useState(null);

  // Filter and pagination
  const filtered = useMemo(() => {
    if (!searchTerm.trim()) return users;
    const q = searchTerm.toLowerCase();
    return users.filter(
      (u) =>
        u.name?.toLowerCase().includes(q) ||
        u.username?.toLowerCase().includes(q) ||
        u.email?.toLowerCase().includes(q) ||
        u.roles?.[0]?.name?.toLowerCase().includes(q),
    );
  }, [users, searchTerm]);

  const sorted = useMemo(() => {
    return [...filtered].sort((a, b) => b.id - a.id);
  }, [filtered]);

  const totalPages = Math.ceil(sorted.length / itemsPerPage);
  const paginated = sorted.slice(
    (currentPage - 1) * itemsPerPage,
    currentPage * itemsPerPage,
  );

  // Stats
  const adminCount = users.filter((u) => u.roles?.[0]?.name === "Admin").length;
  const userCount = users.filter((u) => u.roles?.[0]?.name === "User").length;

  // Handlers
  const openCreateModal = () => {
    setEditingUser(null);
    setFormData(INITIAL_FORM);
    setPreviewImage(null);
    setShowPassword(false);
    setShowModal(true);
  };

  const openEditModal = (user) => {
    setEditingUser(user);
    setFormData({
      name: user.name || "",
      username: user.username || "",
      email: user.email || "",
      password: "",
      role: user.roles?.[0]?.name || "User",
      profile: null,
    });
    setPreviewImage(
      user.profile
        ? `${import.meta.env.VITE_API_BASE_URL?.replace("/api", "")}/storage/${user.profile}`
        : null,
    );
    setShowPassword(false);
    setShowModal(true);
  };

  const openDeleteModal = (user) => {
    setDeletingUser(user);
    setShowDeleteModal(true);
  };

  const handleFileChange = (e) => {
    const file = e.target.files?.[0];
    if (file) {
      setFormData({ ...formData, profile: file });
      setPreviewImage(URL.createObjectURL(file));
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setFormLoading(true);
    try {
      if (editingUser) {
        await updateUser(editingUser.id, formData);
        toastr.success("Pengguna berhasil diperbarui");
      } else {
        await createUser(formData);
        toastr.success("Pengguna berhasil ditambahkan");
      }
      setShowModal(false);
      setFormData(INITIAL_FORM);
      setPreviewImage(null);
    } catch (err) {
      const msg =
        err.response?.data?.message ||
        (editingUser
          ? "Gagal memperbarui pengguna"
          : "Gagal menambahkan pengguna");
      toastr.error(msg);
    } finally {
      setFormLoading(false);
    }
  };

  const handleDelete = async () => {
    setFormLoading(true);
    try {
      await deleteUser(deletingUser.id);
      toastr.success("Pengguna berhasil dihapus");
      setShowDeleteModal(false);
      setDeletingUser(null);
    } catch (err) {
      toastr.error(err.response?.data?.message || "Gagal menghapus pengguna");
    } finally {
      setFormLoading(false);
    }
  };

  const getInitials = (name) => {
    if (!name) return "?";
    return name
      .split(" ")
      .map((n) => n[0])
      .join("")
      .substring(0, 2)
      .toUpperCase();
  };

  if (loading) return <Loading />;

  return (
    <div className="p-6">
      <HeaderCard
        title="Manajemen Pengguna"
        subtitle={`Total ${users.length} pengguna terdaftar`}
      />

      {error ? (
        <div className="mt-6 text-center text-red-500">{error}</div>
      ) : (
        <>
          {/* Stats Cards */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <Users className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">
                  Total Pengguna
                </p>
                <p className="text-2xl font-bold text-gray-900">
                  {users.length}
                </p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-orange-500/20">
                <Shield className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">Admin</p>
                <p className="text-2xl font-bold text-gray-900">{adminCount}</p>
              </div>
            </div>
            <div className="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
              <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-400 to-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <User className="w-6 h-6 text-white" />
              </div>
              <div>
                <p className="text-sm text-gray-500 font-medium">User</p>
                <p className="text-2xl font-bold text-gray-900">{userCount}</p>
              </div>
            </div>
          </div>

          {/* Toolbar */}
          <div className="mt-6 flex flex-col sm:flex-row items-center gap-3">
            <div className="flex-1 w-full">
              <SearchBar
                onSearch={(val) => {
                  setSearchTerm(val);
                  setCurrentPage(1);
                }}
                placeholder="Cari nama, username, email, atau role..."
              />
            </div>
            <button
              onClick={openCreateModal}
              className="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-medium text-sm shrink-0"
            >
              <UserPlus className="w-4 h-4" />
              Tambah Pengguna
            </button>
          </div>

          {/* Table */}
          <div className="mt-4 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div className="overflow-x-auto">
              <table className="w-full text-sm">
                <thead>
                  <tr className="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <th className="text-left p-4 font-semibold text-gray-700 w-12">
                      No
                    </th>
                    <th className="text-left p-4 font-semibold text-gray-700">
                      Pengguna
                    </th>
                    <th className="text-left p-4 font-semibold text-gray-700">
                      Username
                    </th>
                    <th className="text-left p-4 font-semibold text-gray-700">
                      Role
                    </th>
                    <th className="text-center p-4 font-semibold text-gray-700">
                      Aksi
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {paginated.length === 0 ? (
                    <tr>
                      <td colSpan="5" className="p-8 text-center text-gray-500">
                        {searchTerm
                          ? "Tidak ada pengguna ditemukan."
                          : "Belum ada pengguna terdaftar."}
                      </td>
                    </tr>
                  ) : (
                    paginated.map((user, idx) => {
                      const role = user.roles?.[0]?.name || "User";
                      return (
                        <tr
                          key={user.id}
                          className="border-b border-gray-100 hover:bg-indigo-50/30 transition"
                        >
                          <td className="p-4 text-gray-500 font-medium">
                            {(currentPage - 1) * itemsPerPage + idx + 1}
                          </td>
                          <td className="p-4">
                            <div className="flex items-center gap-3">
                              <div className="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold shrink-0 overflow-hidden">
                                {user.profile ? (
                                  <img
                                    src={`${import.meta.env.VITE_API_BASE_URL?.replace("/api", "")}/storage/${user.profile}`}
                                    alt={user.name}
                                    className="w-full h-full object-cover"
                                  />
                                ) : (
                                  getInitials(user.name)
                                )}
                              </div>
                              <div>
                                <p className="font-semibold text-gray-900">
                                  {user.name}
                                </p>
                                <p className="text-xs text-gray-500">
                                  {user.email}
                                </p>
                              </div>
                            </div>
                          </td>
                          <td className="p-4">
                            <span className="text-gray-600 font-mono text-xs">
                              @{user.username}
                            </span>
                          </td>
                          <td className="p-4">
                            <span
                              className={`inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium ${
                                role === "Admin"
                                  ? "bg-amber-50 text-amber-700"
                                  : "bg-blue-50 text-blue-700"
                              }`}
                            >
                              {role === "Admin" ? (
                                <Shield className="w-3 h-3" />
                              ) : (
                                <User className="w-3 h-3" />
                              )}
                              {role}
                            </span>
                          </td>
                          <td className="p-4">
                            <div className="flex items-center justify-center gap-2">
                              <button
                                onClick={() => openEditModal(user)}
                                className="p-2 rounded-lg text-indigo-600 hover:bg-indigo-50 transition"
                                title="Edit"
                              >
                                <Edit3 className="w-4 h-4" />
                              </button>
                              <button
                                onClick={() => openDeleteModal(user)}
                                className="p-2 rounded-lg text-red-500 hover:bg-red-50 transition"
                                title="Hapus"
                              >
                                <Trash2 className="w-4 h-4" />
                              </button>
                            </div>
                          </td>
                        </tr>
                      );
                    })
                  )}
                </tbody>
              </table>
            </div>
          </div>

          {/* Pagination */}
          {totalPages > 1 && (
            <div className="mt-4">
              <Pagination
                currentPage={currentPage}
                totalPages={totalPages}
                onPageChange={setCurrentPage}
                totalItems={sorted.length}
                itemsPerPage={itemsPerPage}
              />
            </div>
          )}
        </>
      )}

      {/* Create/Edit Modal */}
      {showModal && (
        <Modal
          title={editingUser ? "Edit Pengguna" : "Tambah Pengguna"}
          onClose={() => {
            setShowModal(false);
            setFormData(INITIAL_FORM);
            setPreviewImage(null);
          }}
          className="max-w-lg"
        >
          <form onSubmit={handleSubmit} className="space-y-4">
            {/* Profile Image */}
            <div className="flex flex-col items-center gap-3">
              <div className="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold overflow-hidden border-4 border-white shadow-lg">
                {previewImage ? (
                  <img
                    src={previewImage}
                    alt="Preview"
                    className="w-full h-full object-cover"
                  />
                ) : (
                  getInitials(formData.name)
                )}
              </div>
              <label className="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg cursor-pointer hover:bg-gray-200 transition text-sm">
                <Image className="w-4 h-4" />
                Pilih Foto
                <input
                  type="file"
                  accept="image/jpeg,image/png,image/jpg"
                  onChange={handleFileChange}
                  className="hidden"
                />
              </label>
            </div>

            {/* Name */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Nama Lengkap
              </label>
              <div className="relative">
                <User className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input
                  type="text"
                  value={formData.name}
                  onChange={(e) =>
                    setFormData({ ...formData, name: e.target.value })
                  }
                  className="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm"
                  placeholder="Masukkan nama lengkap"
                  required
                />
              </div>
            </div>

            {/* Username */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Username
              </label>
              <div className="relative">
                <AtSign className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input
                  type="text"
                  value={formData.username}
                  onChange={(e) =>
                    setFormData({ ...formData, username: e.target.value })
                  }
                  className="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm"
                  placeholder="Masukkan username"
                  required
                />
              </div>
            </div>

            {/* Email */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Email
              </label>
              <div className="relative">
                <Mail className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input
                  type="email"
                  value={formData.email}
                  onChange={(e) =>
                    setFormData({ ...formData, email: e.target.value })
                  }
                  className="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm"
                  placeholder="Masukkan email"
                  required
                />
              </div>
            </div>

            {/* Password */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Password{" "}
                {editingUser && (
                  <span className="text-gray-400 font-normal">
                    (kosongkan jika tidak diubah)
                  </span>
                )}
              </label>
              <div className="relative">
                <Lock className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input
                  type={showPassword ? "text" : "password"}
                  value={formData.password}
                  onChange={(e) =>
                    setFormData({ ...formData, password: e.target.value })
                  }
                  className="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm"
                  placeholder={
                    editingUser ? "Biarkan kosong" : "Masukkan password"
                  }
                  {...(!editingUser && { required: true, minLength: 6 })}
                />
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                >
                  {showPassword ? (
                    <EyeOff className="w-4 h-4" />
                  ) : (
                    <Eye className="w-4 h-4" />
                  )}
                </button>
              </div>
            </div>

            {/* Role */}
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Role
              </label>
              <div className="relative">
                <Shield className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <select
                  value={formData.role}
                  onChange={(e) =>
                    setFormData({ ...formData, role: e.target.value })
                  }
                  className="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm appearance-none bg-white"
                >
                  <option value="User">User</option>
                  <option value="Admin">Admin</option>
                </select>
              </div>
            </div>

            {/* Actions */}
            <div className="flex gap-3 pt-2">
              <button
                type="button"
                onClick={() => {
                  setShowModal(false);
                  setFormData(INITIAL_FORM);
                  setPreviewImage(null);
                }}
                className="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium text-sm"
              >
                Batal
              </button>
              <button
                type="submit"
                disabled={formLoading}
                className="flex-1 px-4 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-medium text-sm disabled:opacity-50"
              >
                {formLoading
                  ? "Menyimpan..."
                  : editingUser
                    ? "Perbarui"
                    : "Tambah"}
              </button>
            </div>
          </form>
        </Modal>
      )}

      {/* Delete Confirmation Modal */}
      {showDeleteModal && deletingUser && (
        <Modal
          title="Hapus Pengguna"
          onClose={() => {
            setShowDeleteModal(false);
            setDeletingUser(null);
          }}
        >
          <div className="space-y-4">
            <div className="flex items-center gap-3 p-3 bg-red-50 rounded-xl">
              <div className="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold shrink-0">
                {getInitials(deletingUser.name)}
              </div>
              <div>
                <p className="font-semibold text-gray-900">
                  {deletingUser.name}
                </p>
                <p className="text-xs text-gray-500">{deletingUser.email}</p>
              </div>
            </div>
            <p className="text-sm text-gray-600">
              Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak
              dapat dibatalkan.
            </p>
            <div className="flex gap-3">
              <button
                onClick={() => {
                  setShowDeleteModal(false);
                  setDeletingUser(null);
                }}
                className="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition font-medium text-sm"
              >
                Batal
              </button>
              <button
                onClick={handleDelete}
                disabled={formLoading}
                className="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-medium text-sm disabled:opacity-50"
              >
                {formLoading ? "Menghapus..." : "Hapus"}
              </button>
            </div>
          </div>
        </Modal>
      )}
    </div>
  );
};

export default UserPage;
