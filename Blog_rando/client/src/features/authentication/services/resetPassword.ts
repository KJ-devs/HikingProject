import axios from '../../../lib/axios'



const resetPassword = async (email: string) => {
  if (email ) {
    try {
      const response = await axios.post(`/auth/resetPassword`, {
        email,
      });
      if (response.status === 200 ) {
        
        return "Success";
      }
    } catch (error) {
      throw new Error("reset password unsuccessful");
    }
  
  };
}


export default { resetPassword };
