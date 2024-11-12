

const logout = async () => {
  try {
    // Supprimer le token du stockage local
    localStorage.removeItem('token');
  } catch (error) {
    // Gérer les erreurs potentielles
    console.error("Logout unsuccessful:", error);
    throw new Error("Logout unsuccessful");
  }
};

export default { logout };
