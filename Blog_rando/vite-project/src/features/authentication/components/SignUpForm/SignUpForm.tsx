import { useState } from "react";
import authService from "../../services/signUp";
import {
  Button,
  Group,
  PasswordInput,
  TextInput,
  Container,
  Popover,
  Progress,
} from "@mantine/core";
import { useForm } from "@mantine/form";

import PasswordRequirement from "./PasswordRequirement";

import {
  requirements,
  getStrength,
  validatePassword,
  validateEmail,
} from "../../utils/signUpUtils";

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
      password: (value) => {
        return validatePassword(value);
      },
    },
  });

  const registration = async (values: { email: string; password: string }) => {
    try {
      const response = await authService.signUp(values.email, values.password);
      console.log(response);
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

  const styleProps = {
    h: 50,
    mt: "md",
  };

  return (
    <Container size="xs" {...styleProps}>
      <form onSubmit={form.onSubmit((values) => registration(values))}>
        <TextInput
          withAsterisk
          label="Email"
          placeholder="exemple@exemple.com"
          key={form.key("email")}
          {...form.getInputProps("email")}
          value={email}
          onChange={(e) => {
            setEmail(e.target.value);
            form.setFieldValue("email", e.target.value);
          }}
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
                key={form.key("password")}
                {...form.getInputProps("password")}
                value={password}
                onChange={(event) => {
                  setPassword(event.currentTarget.value);
                  form.setFieldValue("password", event.currentTarget.value);
                }}
              />
            </div>
          </Popover.Target>
          <Popover.Dropdown>
            <Progress color={color} value={strength} size={5} mb="xs" />

            {checks}
          </Popover.Dropdown>
        </Popover>
        <Group justify="flex-end" mt="md">
          <Button type="submit">Inscription</Button>
        </Group>
      </form>
    </Container>
  );
}

export default SignUpForm;
