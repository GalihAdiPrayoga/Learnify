import { Outlet } from "react-router-dom";

/**
 * PublicRoute - allows access without authentication
 * Still uses UserLayouts (navbar + footer)
 */
export default function PublicRoute({ children }) {
  return children || <Outlet />;
}
