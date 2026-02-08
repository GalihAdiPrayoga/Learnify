import React from "react";
import { useDashboard } from "../hooks/useDashboard";
import Loading from "@/components/Loading";
import NotFound from "@/features/error/notfound";
import {
  Users,
  BookOpen,
  PenTool,
  CheckCircle,
  FileText,
  ClipboardList,
  TrendingUp,
  Activity
} from "lucide-react";
import {
  AreaChart,
  Area,
  BarChart,
  Bar,
  PieChart,
  Pie,
  Cell,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer,
} from "recharts";

function AdminDashboard() {
  const { dashboardData, loading, error, refetch } = useDashboard();

  if (loading) return <Loading />;

  if (error) {
    return (
      <NotFound
        title="Gagal Memuat Dashboard"
        message={error || "Terjadi kesalahan saat mengambil data dashboard."}
        type="error"
        onRetry={refetch}
      />
    );
  }

  const { stats, charts } = dashboardData;

  // Stats cards configuration
  const statsOverview = [
    {
      label: "Total Pengguna",
      value: stats?.totalUsers ?? 0,
      icon: Users,
      color: "bg-blue-50 text-blue-600",
      trend: "+12% dari bulan lalu" // Dummy trend for visuals
    },
    {
      label: "Total Kelas",
      value: stats?.totalKelas ?? 0,
      icon: BookOpen,
      color: "bg-indigo-50 text-indigo-600",
      trend: "+5 kelas baru"
    },
    {
      label: "Pendaftaran Aktif",
      value: stats?.activeEnrollments ?? 0,
      icon: PenTool,
      color: "bg-violet-50 text-violet-600",
      trend: "Sedang berjalan"
    },
    {
      label: "Tingkat Penyelesaian",
      value: `${stats?.completionRate ?? 0}%`,
      icon: CheckCircle,
      color: "bg-emerald-50 text-emerald-600",
      trend: "+2% peningkatan"
    },
  ];

  const secondaryStats = [
      {
        label: "Total Materi",
        value: stats?.totalMateri ?? 0,
        icon: FileText,
        color: "bg-orange-50 text-orange-600"
      },
      {
        label: "Total Ujian",
        value: stats?.totalExams ?? 0,
        icon: ClipboardList,
         color: "bg-pink-50 text-pink-600"
      },
      {
        label: "Rata-rata Nilai",
        value: stats?.averageScore ?? 0,
        icon: TrendingUp,
         color: "bg-cyan-50 text-cyan-600"
      }
  ];

  // Prepare chart data
  const enrollmentChartData =
    charts?.recentEnrollments?.map((item) => ({
      date: new Date(item.date).toLocaleDateString("id-ID", {
        month: "short",
        day: "numeric",
      }),
      enrollments: item.count,
    })) ?? [];

  const popularCoursesData =
    charts?.popularCourses?.map((course) => ({
      name: course.nama,
      enrollments: course.enrollments,
    })) ?? [];

  const monthlyRegistrationsData =
    charts?.monthlyRegistrations?.map((item) => ({
      month: item.month,
      registrations: item.count,
    })) ?? [];

  // Exam statistics for pie chart
  const examData = [
    { name: "Lulus", value: stats?.passRate ?? 0 },
    { name: "Gagal", value: 100 - (stats?.passRate ?? 0) },
  ];

  const COLORS = ["#10b981", "#ef4444"];

  return (
    <div className="p-8 space-y-8 min-h-screen">
      {/* Header */}
      <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <h1 className="text-3xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
          <p className="text-slate-500 mt-1">
            Selamat datang kembali di panel administrasi Learnify.
          </p>
        </div>
        <div className="flex items-center gap-2 bg-white px-4 py-2 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 shadow-sm">
            <Activity className="w-4 h-4 text-indigo-500" />
            <span>Update Terakhir: {new Date().toLocaleDateString('id-ID')}</span>
        </div>
      </div>

      {/* Primary Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {statsOverview.map((stat, idx) => {
          const IconComponent = stat.icon;
          return (
            <div
              key={idx}
              className="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:shadow-indigo-900/5 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden"
            >
              <div className="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                  <IconComponent size={64} className={stat.color.split(" ")[1]} />
              </div>
              
              <div className="relative">
                <div className={`w-12 h-12 rounded-xl flex items-center justify-center mb-4 ${stat.color} shadow-sm group-hover:scale-110 transition-transform`}>
                    <IconComponent size={24} strokeWidth={2.5} />
                </div>
                <p className="text-slate-500 text-sm font-semibold uppercase tracking-wider">{stat.label}</p>
                <div className="flex items-end gap-3 mt-1">
                    <h3 className="text-3xl font-bold text-slate-800">{stat.value}</h3>
                </div>
                <p className="text-xs font-medium text-green-600 mt-2 flex items-center gap-1 bg-green-50 w-fit px-2 py-1 rounded-full">
                    <TrendingUp size={12} />
                    {stat.trend}
                </p>
              </div>
            </div>
          );
        })}
      </div>
      
      {/* Secondary Stats Row */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {secondaryStats.map((stat, idx) => {
              const IconComponent = stat.icon;
              return (
                <div key={idx} className="bg-white px-6 py-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-indigo-100 transition-colors">
                    <div>
                        <p className="text-slate-500 text-sm font-medium">{stat.label}</p>
                        <p className="text-2xl font-bold text-slate-800 mt-1 group-hover:text-indigo-600 transition-colors">{stat.value}</p>
                    </div>
                    <div className={`w-10 h-10 rounded-lg flex items-center justify-center ${stat.color} bg-opacity-20`}>
                        <IconComponent size={20} />
                    </div>
                </div>
              )
          })}
      </div>

      {/* Charts Section */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {/* Recent Enrollments - Area Chart */}
        <div className="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
          <div className="flex items-center justify-between mb-6">
             <div>
                <h3 className="text-lg font-bold text-slate-800">
                    Pendaftaran Terbaru
                </h3>
                <p className="text-sm text-slate-500">Aktivitas pendaftaran 7 hari terakhir</p>
             </div>
          </div>
          <div className="h-[300px] w-full">
          <ResponsiveContainer width="100%" height="100%">
            <AreaChart data={enrollmentChartData}>
              <defs>
                <linearGradient
                  id="colorEnrollments"
                  x1="0"
                  y1="0"
                  x2="0"
                  y2="1"
                >
                  <stop offset="5%" stopColor="#6366f1" stopOpacity={0.3} />
                  <stop offset="95%" stopColor="#6366f1" stopOpacity={0} />
                </linearGradient>
              </defs>
              <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#e2e8f0" />
              <XAxis 
                dataKey="date" 
                axisLine={false} 
                tickLine={false} 
                tick={{fill: '#64748b', fontSize: 12}} 
                dy={10}
              />
              <YAxis 
                axisLine={false} 
                tickLine={false} 
                tick={{fill: '#64748b', fontSize: 12}} 
              />
              <Tooltip 
                contentStyle={{ borderRadius: '8px', border: 'none', boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)' }}
                cursor={{ stroke: '#6366f1', strokeWidth: 1, strokeDasharray: '4 4' }}
              />
              <Area
                type="monotone"
                dataKey="enrollments"
                stroke="#6366f1"
                strokeWidth={3}
                fillOpacity={1}
                fill="url(#colorEnrollments)"
                activeDot={{ r: 6, strokeWidth: 0, fill: '#4f46e5' }}
              />
            </AreaChart>
          </ResponsiveContainer>
          </div>
        </div>

        {/* User Growth - Area Chart */}
        <div className="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
          <div className="flex items-center justify-between mb-6">
             <div>
                <h3 className="text-lg font-bold text-slate-800">
                    Pertumbuhan Pengguna
                </h3>
                <p className="text-sm text-slate-500">Registrasi pengguna bulanan</p>
             </div>
          </div>
          <div className="h-[300px] w-full">
          <ResponsiveContainer width="100%" height="100%">
            <AreaChart data={monthlyRegistrationsData}>
              <defs>
                <linearGradient
                  id="colorRegistrations"
                  x1="0"
                  y1="0"
                  x2="0"
                  y2="1"
                >
                  <stop offset="5%" stopColor="#10b981" stopOpacity={0.3} />
                  <stop offset="95%" stopColor="#10b981" stopOpacity={0} />
                </linearGradient>
              </defs>
               <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#e2e8f0" />
              <XAxis 
                 dataKey="month" 
                 axisLine={false} 
                 tickLine={false} 
                 tick={{fill: '#64748b', fontSize: 12}} 
                 dy={10}
              />
              <YAxis 
                 axisLine={false} 
                 tickLine={false} 
                 tick={{fill: '#64748b', fontSize: 12}} 
              />
              <Tooltip 
                  contentStyle={{ borderRadius: '8px', border: 'none', boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)' }}
              />
              <Area
                type="monotone"
                dataKey="registrations"
                stroke="#10b981"
                strokeWidth={3}
                fillOpacity={1}
                fill="url(#colorRegistrations)"
                activeDot={{ r: 6, strokeWidth: 0, fill: '#059669' }}
              />
            </AreaChart>
          </ResponsiveContainer>
          </div>
        </div>

        {/* Popular Courses - Bar Chart */}
        <div className="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 lg:col-span-1">
          <div className="mb-6">
                <h3 className="text-lg font-bold text-slate-800">
                    Kelas Terpopuler
                </h3>
                <p className="text-sm text-slate-500">5 kelas dengan pendaftar terbanyak</p>
          </div>
          <div className="h-[300px] w-full">
          <ResponsiveContainer width="100%" height="100%">
            <BarChart data={popularCoursesData} layout="vertical">
               <CartesianGrid strokeDasharray="3 3" horizontal={false} stroke="#e2e8f0" />
              <XAxis type="number" hide />
              <YAxis 
                dataKey="name" 
                type="category" 
                width={150} 
                tick={{fontSize: 11, fill: '#475569'}}
                tickLine={false}
                axisLine={false}
              />
              <Tooltip 
                  cursor={{fill: '#f1f5f9'}}
                  contentStyle={{ borderRadius: '8px', border: 'none', boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)' }}
              />
              <Bar dataKey="enrollments" fill="#3b82f6" radius={[0, 4, 4, 0]} barSize={20}>
                 {popularCoursesData.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={['#6366f1', '#8b5cf6', '#a855f7', '#d946ef', '#ec4899'][index % 5]} />
                 ))}
              </Bar>
            </BarChart>
          </ResponsiveContainer>
          </div>
        </div>

        {/* Exam Pass Rate - Pie Chart */}
        <div className="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 lg:col-span-1">
          <div className="mb-6">
                <h3 className="text-lg font-bold text-slate-800">
                    Tingkat Kelulusan Ujian
                </h3>
                <p className="text-sm text-slate-500">Perbandingan kelulusan peserta</p>
          </div>
          <div className="h-[300px] w-full flex items-center justify-center">
          <ResponsiveContainer width="100%" height="100%">
            <PieChart>
              <Pie
                data={examData}
                cx="50%"
                cy="50%"
                innerRadius={60}
                outerRadius={100}
                paddingAngle={5}
                dataKey="value"
              >
                {examData.map((entry, index) => (
                  <Cell
                    key={`cell-${index}`}
                    fill={COLORS[index % COLORS.length]}
                    strokeWidth={0}
                  />
                ))}
              </Pie>
              <Tooltip 
                   contentStyle={{ borderRadius: '8px', border: 'none', boxShadow: '0 4px 6px -1px rgb(0 0 0 / 0.1)' }}
              />
              <Legend verticalAlign="bottom" height={36} iconType="circle" />
            </PieChart>
          </ResponsiveContainer>
          </div>
        </div>
      </div>
    </div>
  );
}

export default AdminDashboard;
