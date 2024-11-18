import { useState, useEffect, useContext } from "react";
import axios from "../lib/axios";
import NavBar from "../components/navbar/Navbar";
import { AuthContext } from "@src/features/authentication/components/AuthContext";

function Profil() {
  const [username, setUsername] = useState("");
  const authContext = useContext(AuthContext);

  useEffect(() => {
    const fetchProfile = async () => {
      if (!authContext) {
        console.error("AuthContext is not available.");
        return;
      }

      try {
        const { token } = authContext;
        if (!token) {
          throw new Error("Token non trouvé");
        }

        const response = await axios.get("api/profile", {
          headers: { Authorization: `Bearer ${token}` },
        });
        setUsername(response.data.username);
      } catch (error) {
        console.error("Erreur lors de la récupération du profil :", error);
      }
    };

    fetchProfile();
  }, [authContext]);

  return (
    <>
      <NavBar />
      <div>
        <h1>Profil de {username}</h1>
        {/* Affichez d'autres informations du profil ici */}
      </div>
    </>
  );
}

export default Profil;
