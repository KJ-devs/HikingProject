
 export const requirements = [
  { re: /[0-9]/, label: "Contient un chiffre" },
  { re: /[a-z]/, label: "Contient une minuscule" },
  { re: /[A-Z]/, label: "Contient une majuscule" },
  { re: /[$&+,:;=?@#|'<>.^*()%!-]/, label: "Contient un symbole spécial" },
];

export function getStrength(password: string) {
  let multiplier = password.length > 7 ? 0 : 1;

  requirements.forEach((requirement) => {
    if (!requirement.re.test(password)) {
      multiplier += 1;
    }
  });

  return Math.max(100 - (100 / (requirements.length + 1)) * multiplier, 10);
}

export function checkPassword(password: string) {
  return requirements.map((requirement) => requirement.re.test(password));
}

// src/validation/userValidation.ts

export const validateEmail = (value: string): string | null => 
  /^\S+@\S+$/.test(value)
    ? null
    : "Votre email n'est pas valide (exemple@free.fr)";

export const validatePassword = (value: string): string | null => {
  if (!value) {
    return "Le mot de passe ne peut pas être vide";
  } else if (value.length < 8) {
    return "Le mot de passe doit contenir au moins 8 caractères";
  } else if (!/[A-Z]/.test(value)) {
    return "Le mot de passe doit contenir au moins une majuscule";
  } else if (!/[a-z]/.test(value)) {
    return "Le mot de passe doit contenir au moins une minuscule";
  } else if (!/\d/.test(value)) {
    return "Le mot de passe doit contenir au moins un chiffre";
  } else if (!/\W/.test(value)) {
    return "Le mot de passe doit contenir au moins un caractère spécial";
  }
  return null;
};
