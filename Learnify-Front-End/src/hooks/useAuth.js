import { useState, useEffect } from "react";
import { getToken } from "@/services/storage/token";

export const useAuth = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const checkAuth = () => {
      try {
        const token = getToken();
        const roles = localStorage.getItem("roles");
        setIsAuthenticated(!!(token && roles));
      } catch (error) {
        setIsAuthenticated(false);
      } finally {
        setIsLoading(false);
      }
    };

    checkAuth();

    // Listen for storage changes (logout in another tab)
    const handleStorageChange = () => checkAuth();
    window.addEventListener("storage", handleStorageChange);

    return () => window.removeEventListener("storage", handleStorageChange);
  }, []);

  return { isAuthenticated, isLoading };
};
