import { Text, Box } from "@mantine/core";
import { IconX, IconCheck } from "@tabler/icons-react";
import { rem } from "@mantine/core";

interface PasswordRequirementProps {
  meets: boolean;
  label: string;
}

function PasswordRequirement({ meets, label }: PasswordRequirementProps) {
  return (
    <Text
      c={meets ? "teal" : "red"}
      style={{ display: "flex", alignItems: "center" }}
      mt={7}
      size="sm"
    >
      {meets ? (
        <IconCheck style={{ width: rem(14), height: rem(14) }} />
      ) : (
        <IconX style={{ width: rem(14), height: rem(14) }} />
      )}{" "}
      <Box ml={10}>{label}</Box>
    </Text>
  );
}


export default PasswordRequirement;
