import { useState } from "react";
import authService from "../../services/signUp";
import {
  Button,
  TextInput,
  PasswordInput,
  Popover,
  Progress,
  Box,
  Text,
  Title,
  Flex,
  BackgroundImage,
} from "@mantine/core";
import { useForm } from "@mantine/form";
import PasswordRequirement from "./PasswordRequirement";
import {
  requirements,
  getStrength,
  validatePassword,
  validateEmail,
} from "../../utils/signUpUtils";
import { Link } from "react-router-dom";
import { FaHiking } from "react-icons/fa";

function SignUpForm() {
  const [popoverOpened, setPopoverOpened] = useState(false);
  const [password, setPassword] = useState("");
  const [email, setEmail] = useState("");

  const form = useForm({
    initialValues: {
      email: "",
      password: "",
    },
    validate: {
      email: (value) => validateEmail(value),
      password: (value) => validatePassword(value),
    },
  });

  const registration = async (values: { email: string; password: string }) => {
    try {
      await authService.signUp(values.email, values.password);
    } catch (error) {
      if (error instanceof Error) {
        console.log(error.message);
      }
    }
  };

  const checks = requirements.map((requirement, index) => (
    <PasswordRequirement
      key={index}
      label={requirement.label}
      meets={requirement.re.test(password)}
    />
  ));

  const strength = getStrength(password);
  const color = strength === 100 ? "teal" : strength > 50 ? "yellow" : "red";

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
            <Title order={2} mb="sm" fw={700} className="text-green-700">
              Sign Up
            </Title>
            <Text c="dimmed">Create your account to join the adventure</Text>
          </Flex>
          <form onSubmit={form.onSubmit((values) => registration(values))}>
            <TextInput
              withAsterisk
              label="Email"
              placeholder="exemple@exemple.com"
              {...form.getInputProps("email")}
              value={email}
              onChange={(e) => {
                setEmail(e.target.value);
                form.setFieldValue("email", e.target.value);
              }}
              mb="lg"
            />
            <Popover
              opened={popoverOpened}
              position="bottom"
              width="target"
              transitionProps={{ transition: "pop" }}
            >
              <Popover.Target>
                <div
                  onFocusCapture={() => setPopoverOpened(true)}
                  onBlurCapture={() => setPopoverOpened(false)}
                >
                  <PasswordInput
                    withAsterisk
                    label="Mot de passe"
                    placeholder="Votre mot de passe"
                    {...form.getInputProps("password")}
                    value={password}
                    onChange={(event) => {
                      setPassword(event.currentTarget.value);
                      form.setFieldValue("password", event.currentTarget.value);
                    }}
                    mb="lg"
                  />
                </div>
              </Popover.Target>
              <Popover.Dropdown>
                <Progress color={color} value={strength} size={5} mb="xs" />
                {checks}
              </Popover.Dropdown>
            </Popover>
            <Button
              type="submit"
              fullWidth
              color="#26A65B"
              variant="filled"
              mt="md"
              mb="lg"
            >
              Sign Up
            </Button>
            <Text mt="md" className="flex justify-center">
              <span className="text-gray-500 mr-2">
                Already have an account ?
              </span>{" "}
              <Link
                to="/login"
                className="text-green-600 hover:underline transition duration-200"
              >
                Sign in
              </Link>
            </Text>
          </form>
        </Box>
      </Flex>
    </BackgroundImage>
  );
}

export default SignUpForm;
