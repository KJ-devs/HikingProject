import { useState, ReactNode } from "react";
import { AuthContext } from "./AuthContext";
import { login as loginService } from "../services/authService";

export const AuthProvider = ({ children }: { children: ReactNode }) => {
  const [token, setToken] = useState<string | null>(null);

  const login = async (
    email: string,
    password: string
  ): Promise<string | null> => {
    const token = await loginService(email, password);
    if (token) {
      setToken(token);
      sessionStorage.setItem("token", token); 
    }
    return token;
  };

  const logout = () => {
    setToken(null);
    sessionStorage.removeItem("token");
  };

  return (
    <AuthContext.Provider value={{ token, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};
