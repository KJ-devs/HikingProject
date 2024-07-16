import React from "react";
import { Badge, Group, Text } from "@mantine/core";
const ArticleTitle = ({ title }: { title: string }) => {
  return (
    <Group justify="space-between" mt="md" mb="xs">
      <Text fw={500}>{title}</Text>
    </Group>
  );
};

export default ArticleTitle;
