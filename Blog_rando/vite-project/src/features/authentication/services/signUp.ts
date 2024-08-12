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
      throw new Error((error as any));
    }
  } else {
    throw new Error("Tous les champs sont requis");
  }
}



export default { signUp};
