import React from "react";
import { Avatar, Badge, Group, Text } from "@mantine/core";
import { AiOutlineSafetyCertificate } from "react-icons/ai";
const ArticleProfil = () => {
  return (
    <Group align="center">
      <Avatar
        src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
        alt="Profile Avatar"
        radius="xl"
      />
      <div style={{ textAlign: "center", }}>
        <Text>Nom Prénom</Text>

        <AiOutlineSafetyCertificate />
      </div>
    </Group>
  );
};

export default ArticleProfil;
