import React from "react";
import { Badge, Group, Text } from "@mantine/core";

const ArticleTitle = ({ title }: { title: string }) => {
  return (
    <Group mt="md" mb="xs">
      <Text fw={700} c="#FFCC00" style={{ fontSize: "1.5em" }}>
        {title}
      </Text>
      <Badge color="white" variant="light">
        Newz
      </Badge>
    </Group>
  );
};

export default ArticleTitle;
