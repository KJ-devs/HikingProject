// auth/AuthContext.tsx

import { createContext } from "react";

interface AuthContextProps {
  token: string | null;
  login: (email: string, password: string) => Promise<string | null>;
  logout: () => void;
}

export const AuthContext = createContext<AuthContextProps | undefined>(
  undefined
);
