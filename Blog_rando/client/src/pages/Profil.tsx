import { useState, useEffect } from "react";
import axios from "../lib/axios";
import NavBar from "../components/navbar/Navbar";

function Profil() {
  const [username, setUsername] = useState("");

  useEffect(() => {
    const fetchProfile = async () => {
      try {
        const token = localStorage.getItem("token");
        if (!token) {
          throw new Error("Token non trouvé");
        }
        const response = await axios.get("api/profile", {
          headers: { Authorization: `Bearer ${token}` },
        });
        console.log("Token trouvé :", token);
        console.log("Profil récupéré :", response.data);
        setUsername(response.data);
      } catch (error) {
        console.error("Erreur lors de la récupération du profil :", error);
      }
    };

    fetchProfile();
  }, []);

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
