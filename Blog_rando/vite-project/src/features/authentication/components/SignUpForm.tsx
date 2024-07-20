import React, { useState } from "react";
import authService from "../services/signUp";
import { Button, Group, PasswordInput, TextInput, Container, Text, Popover, Box, Progress, rem } from '@mantine/core';
import { useForm } from '@mantine/form';
import { useNavigate } from "react-router-dom";
import { IconX, IconCheck } from '@tabler/icons-react';

function PasswordRequirement({ meets, label }) {
  return (
    <Text
      color={meets ? 'teal' : 'red'}
      style={{ display: 'flex', alignItems: 'center' }}
      mt={7}
      size="sm"
    >
      {meets ? (
        <IconCheck style={{ width: rem(14), height: rem(14) }} />
      ) : (
        <IconX style={{ width: rem(14), height: rem(14) }} />
      )}{' '}
      <Box ml={10}>{label}</Box>
    </Text>
  );
}

const requirements = [
  { re: /[0-9]/, label: 'Contient un chiffre' },
  { re: /[a-z]/, label: 'Contient une minuscule' },
  { re: /[A-Z]/, label: 'Contient une majuscule' },
  { re: /[$&+,:;=?@#|'<>.^*()%!-]/, label: 'Contient un symbole spécial' },
];

function getStrength(password) {
  let multiplier = password.length > 7 ? 0 : 1;

  requirements.forEach((requirement) => {
    if (!requirement.re.test(password)) {
      multiplier += 1;
    }
  });

  return Math.max(100 - (100 / (requirements.length + 1)) * multiplier, 10);
}

function SignUpForm() {
  const navigate = useNavigate();
  const [popoverOpened, setPopoverOpened] = useState(false);
  const [password, setPassword] = useState('');
  const [email, setEmail] = useState('');

  const form = useForm({
    initialValues: {
      email: '',
      password: '',
    },

    validate: {
      email: (value) => (/^\S+@\S+$/.test(value) ? null : 'Votre email n\'est pas valide (exemple@free.fr)'),
      password: (value) => {
        if (!value) {
          return 'Le mot de passe ne peut pas être vide';
        } else if (value.length < 8) {
          return 'Le mot de passe doit contenir au moins 8 caractères';
        } else if (!/[A-Z]/.test(value)) {
          return 'Le mot de passe doit contenir au moins une majuscule';
        } else if (!/[a-z]/.test(value)) {
          return 'Le mot de passe doit contenir au moins une minuscule';
        } else if (!/\d/.test(value)) {
          return 'Le mot de passe doit contenir au moins un chiffre';
        } else if (!/\W/.test(value)) {
          return 'Le mot de passe doit contenir au moins un caractère spécial';
        }
        return null;
      },
    },
  });

  const registration = async (values) => {
    try {
      const response = await authService.signUp(values.email, values.password);
      console.log(response);
      await handleLogin(values);
    } catch (error) {
      if (error instanceof Error) {
        console.log(error.message);
      }
    }
  };

  const handleLogin = async (values) => {
    try {
      const response = await authService.login(values.email, values.password);
      console.log(response);
      navigate("/");
    } catch (error) {
      if (error instanceof Error) {
        console.log(error.message);
      }
    }
  };

  const checks = requirements.map((requirement, index) => (
    <PasswordRequirement key={index} label={requirement.label} meets={requirement.re.test(password)} />
  ));

  const strength = getStrength(password);
  const color = strength === 100 ? 'teal' : strength > 50 ? 'yellow' : 'red';

  const demoProps = {
    h: 50,
    mt: 'md',
  };

  return (
    <Container size="xs" {...demoProps}>
      <form onSubmit={form.onSubmit((values) => registration(values))}>
        <TextInput
          withAsterisk
          label="Email"
          placeholder="votre@email.com"
          key={form.key('email')}
          {...form.getInputProps('email')}
          value={email}
          onChange={(e) => {
            setEmail(e.target.value);
            form.setFieldValue('email', e.target.value);
          }}
        />
        <Popover opened={popoverOpened} position="bottom" width="target" transitionProps={{ transition: 'pop' }}>
          <Popover.Target>
            <div
              onFocusCapture={() => setPopoverOpened(true)}
              onBlurCapture={() => setPopoverOpened(false)}
            >
              <PasswordInput
                withAsterisk
                label="Mot de passe"
                placeholder="Votre mot de passe"
                key={form.key('password')}
                {...form.getInputProps('password')}
                value={password}
                onChange={(event) => {
                  setPassword(event.currentTarget.value);
                  form.setFieldValue('password', event.currentTarget.value);
                }}
              />
            </div>
          </Popover.Target>
          <Popover.Dropdown>
            <Progress color={color} value={strength} size={5} mb="xs" />
            <PasswordRequirement label="Inclut au moins 8 caractères" meets={password.length > 7} />
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
