import axios from '../../../lib/axios'



const login = async (email: string, password: string) => {
  if (email  && password) {
    try {
      const response = await axios.post(`/auth/login`, {
        email,
        password,
      });
      if (response.status === 200 && response.data.token) {
        // stocker le token
        return response.data.token;
      }
    } catch (error) {
      throw new Error("Authentification unsuccessful");

    }
  
  };
}

export default { login };
