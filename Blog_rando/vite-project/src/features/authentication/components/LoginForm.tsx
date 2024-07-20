import React, { useState } from "react";
import { FaHiking } from "react-icons/fa";
import { Link, useNavigate } from "react-router-dom";
import {
  TextInput,
  PasswordInput,
  Button,
  Box,
  Text,
  Title,
  Flex,
  BackgroundImage,
} from "@mantine/core";
import authService from "../services/login";

function LoginForm() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleLogin = async () => {
    try {
      const response = await authService.login(email, password);
      console.log(response);
      navigate("/");
    } catch (error) {
      if (error instanceof Error) {
        console.log(error.message);
      }
    }
  };

  return (
    <BackgroundImage
      src="https://source.unsplash.com/featured/?hiking"
      style={{ minHeight: "100vh" }}
    >
      <Flex
        direction="column"
        align="center"
        justify="center"
        style={{ minHeight: "100vh" }}
      >
        <Box
          style={{
            backgroundColor: "white",
            backgroundOpacity: 0.9,
            padding: "2rem",
            borderRadius: "0.5rem",
            boxShadow: "0 8px 10px rgba(0, 0, 0, 0.1)",
            backdropFilter: "blur(10px)",
            maxWidth: "400px",
            width: "100%",
            marginBottom: "1.5rem",
          }}
        >
          <Flex
            direction="column"
            align="center"
            justify="center"
            mb="md"
            gap="0"
          >
            <FaHiking className="text-green-600 text-5xl  mr-2" />
            <Flex>
              <Title
                order={2}
                mb="sm"
                fw={700}
                className="text-3xl  text-green-700 "
              >
                Welcome Back
              </Title>
            </Flex>
            <Text c="dimmed">Connectez-vous pour suivre l'aventure</Text>
          </Flex>
          <TextInput
            label="Email"
            placeholder="Email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
            mt="md"
            mb="lg"
          />
          <PasswordInput
            label="Mot de passe"
            placeholder="Mot de passe"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
            mt="md"
            mb="lg"
          />
          <Button
            onClick={handleLogin}
            fullWidth
            color="#26A65B"
            variant="filled"
            mt="md"
            mb="lg"
          >
            Connexion
          </Button>
          <Text mt="md" className="flex justify-center">
            <Link
              to="/register"
              className="text-green-600 hover:underline transition duration-200"
            >
              Vous avez oublié votre mot de passe ?
            </Link>
          </Text>
          <Text mt="md" className="flex justify-center">
            <span className="text-gray-500 mr-2">
              Vous n'avez pas de compte ?
            </span>{" "}
            <Link
              to="/register"
              className="text-green-600 hover:underline transition duration-200"
            >
              S'inscrire
            </Link>
          </Text>
        </Box>
      </Flex>
    </BackgroundImage>
  );
}

export default LoginForm;
