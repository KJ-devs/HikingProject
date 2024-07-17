import React from "react";
import { Text } from "@mantine/core";

const ArticleContent = ({ content }: { content: string }) => {
  return (
    <Text size="md" c="#FAF5E9" style={{ lineHeight: 1.6 }}>
      {content}
    </Text>
  );
};

export default ArticleContent;
