import axios from '../../../lib/axios';

const signUp = async (email: string, password: string) => {
  if (email && password) {
    try {
      const response = await axios.post(`/auth/register`, {
        email,
        password,
      });
      if (response.status === 200) {
        return "Success";
      }
    } catch (error) {
      throw new Error("Inscription non prit en compte");
    }
  } else {
    throw new Error("Tous les champs sont requis");
  }
}

const login = async (email: string, password: string) => {
  if (email && password) {
    try {
      const response = await axios.post(`/auth/login`, {
        email,
        password,
      });
      if (response.status === 200 && response.data.token) {
        // stocker le token
        localStorage.setItem("token", response.data.token);
        return response.data.token;
      }
    } catch (error) {
      throw new Error("Authentification unsuccessful");
    }
  
  };
}

export default { signUp, login };
