import axios from "@src/lib/axios";

export const login = async (email: string, password: string): Promise<string | null> => {
  try {
    const response = await axios.post(`/auth/login`, { email, password });
    if (response.status === 200 && response.data.token) {
      return response.data.token;
    }
  } catch (error) {
    throw new Error("Authentication unsuccessful");
  }
  return null;
};