import React, { useEffect, useState } from "react";
import authService from "../services/signUp";
import { FaHiking } from "react-icons/fa";

function SignUpForm() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const registration = async () => {
    try {
      const response = await authService.signUp(email, password);
      console.log(response);
    } catch (error) {
      if (error instanceof Error) {
        console.log(error.message);
      }
    }
  };

  return (
    <div
      className="min-h-screen flex items-center justify-center bg-cover bg-center"
      style={{
        backgroundImage: 'url("https://source.unsplash.com/featured/?hiking")',
      }}
    >
      <div className="bg-white bg-opacity-90 p-8 rounded-lg shadow-xl max-w-md w-full backdrop-blur-sm">
        <div className="flex flex-col items-center justify-center mb-6">
          <FaHiking className="text-green-600 text-5xl mb-2" />
          <h2 className="text-3xl font-extrabold text-green-700">
            Inscription
          </h2>
        </div>
        <label className="block mb-4">
          <span className="text-gray-700 font-medium">Email</span>
          <input
            type="text"
            className="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-200"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
        </label>
        <label className="block mb-6">
          <span className="text-gray-700 font-medium">Mot de passe</span>
          <input
            type="password"
            className="mt-2 block w-full px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-200"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </label>
        <button
          onClick={registration}
          className="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200"
        >
          Inscription
        </button>
      </div>
    </div>
  );
}

export default SignUpForm;
