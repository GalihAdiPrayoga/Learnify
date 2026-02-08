import React, { useState } from "react";
import { Link, useLocation } from "react-router-dom";
import {
  LayoutDashboard,
  FileQuestion,
  GraduationCap,
  BookOpen,
  CheckCircle,
  Award,
  BarChart3,
  Settings,
  ChevronLeft,
  ChevronDown,
  Menu,
  Users,
} from "lucide-react";

export default function Sidebar() {
  const [isOpen, setIsOpen] = useState(true);
  const [collapsed, setCollapsed] = useState(false);
  const [openSections, setOpenSections] = useState({});
  const location = useLocation();

  const menuSections = [
    {
      title: "Utama",
      items: [
        {
          label: "Dashboard",
          icon: LayoutDashboard,
          path: "/admin/dashboard",
        },
      ],
    },
    {
      title: "Manajemen",
      items: [
        { label: "Kelas", icon: GraduationCap, path: "/admin/kelas" },
        { label: "Materi", icon: BookOpen, path: "/admin/materi" },
        { label: "Soal", icon: FileQuestion, path: "/admin/soal" },
        {
          label: "Hasil Ujian",
          icon: CheckCircle,
          path: "/admin/hasil-ujian",
        },
        { label: "Pengguna", icon: Users, path: "/admin/users" },
      ],
    },
    {
      title: "Laporan",
      items: [
        {
          label: "Progres Pengguna",
          icon: BarChart3,
          path: "/admin/progress",
        },
        { label: "Sertifikat", icon: Award, path: "/admin/sertifikat" },
      ],
    },
    {
      title: "Sistem",
      items: [
        { label: "Pengaturan", icon: Settings, path: "/admin/settings" },
      ],
    },
  ];

  const isActive = (path) => location.pathname.startsWith(path);

  const isSectionActive = (section) =>
    section.items.some((item) => isActive(item.path));

  const toggleSection = (title) => {
    setOpenSections((prev) => ({ ...prev, [title]: !prev[title] }));
  };

  const isSectionOpen = (section) => {
    if (openSections[section.title] !== undefined) {
      return openSections[section.title];
    }
    return isSectionActive(section);
  };

  return (
    <>
      {/* Mobile Toggle Button */}
      <button
        onClick={() => setIsOpen(!isOpen)}
        className="md:hidden fixed bottom-6 right-6 z-50 bg-indigo-600 text-white p-4 shadow-lg shadow-indigo-500/30 rounded-full hover:scale-105 transition-all active:scale-95"
      >
        <Menu className="w-6 h-6" />
      </button>

      {/* Sidebar */}
      <aside
        className={`fixed md:static ${collapsed ? "w-20" : "w-72"} h-screen bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white flex flex-col z-40 transition-all duration-300 shadow-2xl
        ${isOpen ? "translate-x-0" : "-translate-x-full"} md:translate-x-0`}
      >
        {/* Logo */}
        <div
          className={`p-6 border-b border-white/5 flex items-center ${collapsed ? "justify-center" : "justify-between"}`}
        >
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25 shrink-0">
              <GraduationCap className="text-white w-5 h-5" />
            </div>
            {!collapsed && (
              <div>
                <span className="text-lg font-bold tracking-tight text-white">
                  Learnify
                </span>
                <p className="text-[10px] text-slate-500 font-medium tracking-wider uppercase">
                  Admin Panel
                </p>
              </div>
            )}
          </div>
          <button
            onClick={() => setCollapsed(!collapsed)}
            className="hidden md:flex w-7 h-7 items-center justify-center rounded-lg hover:bg-white/10 text-slate-500 hover:text-white transition-colors"
          >
            <ChevronLeft
              className={`w-4 h-4 transition-transform duration-300 ${collapsed ? "rotate-180" : ""}`}
            />
          </button>
        </div>

        {/* Menu */}
        <nav className="flex-1 overflow-y-auto px-3 py-6 space-y-2">
          {menuSections.map((section) => {
            const singleItem = section.items.length === 1;
            const sectionOpen = isSectionOpen(section);
            const sectionActive = isSectionActive(section);

            // Single-item sections render as direct link (no dropdown)
            if (singleItem) {
              const item = section.items[0];
              const IconComponent = item.icon;
              const active = isActive(item.path);
              return (
                <div key={section.title}>
                  {!collapsed && (
                    <p className="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.15em] mb-2 mt-4">
                      {section.title}
                    </p>
                  )}
                  {collapsed && <div className="border-t border-white/5 my-2" />}
                  <Link
                    to={item.path}
                    onClick={() => {
                      if (window.innerWidth < 768) setIsOpen(false);
                    }}
                    title={collapsed ? item.label : undefined}
                    className={`
                      group relative flex items-center ${collapsed ? "justify-center" : ""} gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                      transition-all duration-200 ease-out
                      ${
                        active
                          ? "bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-600/25"
                          : "text-slate-400 hover:text-white hover:bg-white/5"
                      }
                    `}
                  >
                    <div
                      className={`w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200 ${
                        active
                          ? "bg-white/20"
                          : "bg-transparent group-hover:bg-white/5"
                      }`}
                    >
                      <IconComponent
                        className={`w-[18px] h-[18px] transition-all duration-200 ${
                          active
                            ? "text-white"
                            : "text-slate-500 group-hover:text-slate-300"
                        }`}
                      />
                    </div>
                    {!collapsed && (
                      <span className="relative z-10">{item.label}</span>
                    )}
                    {active && !collapsed && (
                      <span className="ml-auto w-1.5 h-1.5 rounded-full bg-white/80" />
                    )}
                  </Link>
                </div>
              );
            }

            // Multi-item sections render as dropdown
            return (
              <div key={section.title}>
                {!collapsed ? (
                  <>
                    <button
                      onClick={() => toggleSection(section.title)}
                      className={`w-full flex items-center justify-between px-3 py-2 rounded-xl text-sm font-bold uppercase tracking-[0.1em] mt-4 mb-1 transition-all duration-200
                        ${
                          sectionActive
                            ? "text-indigo-400"
                            : "text-slate-500 hover:text-slate-300"
                        }
                      `}
                    >
                      <span className="text-[10px]">{section.title}</span>
                      <ChevronDown
                        className={`w-3.5 h-3.5 transition-transform duration-300 ${
                          sectionOpen ? "rotate-180" : ""
                        }`}
                      />
                    </button>
                    <div
                      className={`space-y-1 overflow-hidden transition-all duration-300 ${
                        sectionOpen
                          ? "max-h-96 opacity-100"
                          : "max-h-0 opacity-0"
                      }`}
                    >
                      {section.items.map((item) => {
                        const IconComponent = item.icon;
                        const active = isActive(item.path);
                        return (
                          <Link
                            key={item.path}
                            to={item.path}
                            onClick={() => {
                              if (window.innerWidth < 768) setIsOpen(false);
                            }}
                            className={`
                              group relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                              transition-all duration-200 ease-out ml-1
                              ${
                                active
                                  ? "bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-600/25"
                                  : "text-slate-400 hover:text-white hover:bg-white/5"
                              }
                            `}
                          >
                            <div
                              className={`w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200 ${
                                active
                                  ? "bg-white/20"
                                  : "bg-transparent group-hover:bg-white/5"
                              }`}
                            >
                              <IconComponent
                                className={`w-[18px] h-[18px] transition-all duration-200 ${
                                  active
                                    ? "text-white"
                                    : "text-slate-500 group-hover:text-slate-300"
                                }`}
                              />
                            </div>
                            <span className="relative z-10">{item.label}</span>
                            {active && (
                              <span className="ml-auto w-1.5 h-1.5 rounded-full bg-white/80" />
                            )}
                          </Link>
                        );
                      })}
                    </div>
                  </>
                ) : (
                  <>
                    <div className="border-t border-white/5 my-2" />
                    {section.items.map((item) => {
                      const IconComponent = item.icon;
                      const active = isActive(item.path);
                      return (
                        <Link
                          key={item.path}
                          to={item.path}
                          onClick={() => {
                            if (window.innerWidth < 768) setIsOpen(false);
                          }}
                          title={item.label}
                          className={`
                            group relative flex items-center justify-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                            transition-all duration-200 ease-out mb-1
                            ${
                              active
                                ? "bg-gradient-to-r from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-600/25"
                                : "text-slate-400 hover:text-white hover:bg-white/5"
                            }
                          `}
                        >
                          <div
                            className={`w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all duration-200 ${
                              active
                                ? "bg-white/20"
                                : "bg-transparent group-hover:bg-white/5"
                            }`}
                          >
                            <IconComponent
                              className={`w-[18px] h-[18px] transition-all duration-200 ${
                                active
                                  ? "text-white"
                                  : "text-slate-500 group-hover:text-slate-300"
                              }`}
                            />
                          </div>
                        </Link>
                      );
                    })}
                  </>
                )}
              </div>
            );
          })}
        </nav>

        {/* Footer branding */}
        {!collapsed && (
          <div className="p-4 border-t border-white/5">
            <div className="bg-gradient-to-r from-indigo-600/10 to-purple-600/10 rounded-xl px-4 py-3 border border-indigo-500/10">
              <p className="text-[11px] text-slate-400 font-medium">
                Learnify LMS
              </p>
              <p className="text-[10px] text-slate-600 mt-0.5">v1.0.0</p>
            </div>
          </div>
        )}
      </aside>

      {/* Overlay for mobile */}
      {isOpen && (
        <div
          className="fixed inset-0 bg-black/50 backdrop-blur-sm md:hidden z-30 transition-opacity"
          onClick={() => setIsOpen(false)}
        />
      )}
    </>
  );
}
