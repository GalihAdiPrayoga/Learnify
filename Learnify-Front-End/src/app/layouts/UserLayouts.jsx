import React from "react";
import { Outlet } from "react-router-dom";
import Navbar from "@/app/navigation/user/navbar";
import Footer from "@/app/navigation/user/footer";
import { useAuth } from "@/hooks/useAuth";

const UserChatWidget = React.lazy(
  () => import("@/features/users/components/chat/UserChatWidget"),
);

export default function UserLayouts() {
  const { isAuthenticated } = useAuth();

  return (
    <div className="min-h-screen flex flex-col bg-zinc-50">
      <Navbar />
      <main className="flex-1">
        <Outlet />
      </main>
      <Footer />
      {isAuthenticated && (
        <React.Suspense fallback={null}>
          <UserChatWidget />
        </React.Suspense>
      )}
    </div>
  );
}
