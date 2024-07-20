import { Box, Text } from "@mantine/core";
import { IconX, IconCheck } from "@tabler/icons-react";

interface PasswordRequirementProps {
  meets: boolean;
  label: string;
}

const PasswordRequirement = ({ meets, label }: PasswordRequirementProps) => {
  const color = meets ? "teal" : "red";

  return (
    <Box mt={7} style={{ display: "flex", alignItems: "center", color: color }}>
      {meets ? (
        <IconCheck style={{ width: 14, height: 14 }} />
      ) : (
        <IconX style={{ width: 14, height: 14 }} />
      )}
      <Text ml={10} size="sm" style={{ color: color }}>
        {label}
      </Text>
    </Box>
  );
};

export default PasswordRequirement;
