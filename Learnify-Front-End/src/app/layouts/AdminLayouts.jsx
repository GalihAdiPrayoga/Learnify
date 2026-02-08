import { Outlet } from "react-router-dom";
import { useState, useEffect, useRef } from "react";
import Sidebar from "@/app/navigation/admin/sidebar";
import Header from "@/app/navigation/admin/header";

export default function AdminLayouts() {
  const [hasScrolled, setHasScrolled] = useState(false);
  const mainRef = useRef(null);

  useEffect(() => {
    const mainElement = mainRef.current;
    if (!mainElement) return;

    const handleScroll = () => {
      setHasScrolled(mainElement.scrollTop > 10);
    };

    mainElement.addEventListener("scroll", handleScroll);
    return () => mainElement.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <>
      <style>
        {`
          @media print {
            .admin-sidebar, .admin-header { display: none !important; }
            .admin-layout {
              display: block !important;
              overflow: visible !important;
              height: auto !important;
            }
            .admin-main-col {
              display: block !important;
            }
            .admin-main {
              overflow: visible !important;
              padding: 0 !important;
            }
          }
        `}
      </style>
      <div className="admin-layout flex h-screen overflow-hidden bg-slate-50">
        <div className="admin-sidebar">
          <Sidebar />
        </div>

        <div className="admin-main-col flex flex-1 flex-col">
          <div className="admin-header">
            <Header hasScrolled={hasScrolled} />
          </div>

          <main ref={mainRef} className="admin-main flex-1 overflow-y-auto p-6">
            <Outlet />
          </main>
        </div>
      </div>
    </>
  );
}
