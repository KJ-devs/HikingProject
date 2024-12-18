import { NavLink } from "react-router-dom";
import authService from "../../features/authentication/services/logOut";
import { MantineProvider } from "@mantine/core";
function NavBar() {
  const handleLogout = async () => {
    try {
      // Appeler le service de déconnexion
      authService.logout();
    } catch (error) {
      console.error("Logout failed:", error);
    }
  };

  return (
    <MantineProvider>
      <header className="bg-gray-800 py-4">
        <div className="container mx-auto flex justify-between items-center">
          <h3 className="text-white text-lg font-bold">Logo</h3>
          <nav className="hidden md:block">
            <ul className="flex space-x-4 text-white">
              <li>
                <NavLink to="/" className="hover:text-gray-300">
                  Home
                </NavLink>
              </li>
              <li>
                <NavLink to="/profil" className="hover:text-gray-300">
                  Profil
                </NavLink>
              </li>
              <li>
                <NavLink to="/login" className="hover:text-gray-300">
                  Login
                </NavLink>
              </li>
              <li>
                <NavLink to="/contact" className="hover:text-gray-300">
                  Contact
                </NavLink>
              </li>
              <li>
                <NavLink
                  onClick={handleLogout}
                  to="/login"
                  className="hover:text-gray-300"
                >
                  Déconnexion
                </NavLink>
              </li>
            </ul>
          </nav>
          <div className="md:hidden">
            {/* Responsive Navigation Button */}
            <button className="text-white focus:outline-none">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M4 6h16M4 12h16m-7 6h7"
                />
              </svg>
            </button>
          </div>
        </div>
      </header>
    </MantineProvider>
  );
}

export default NavBar;
