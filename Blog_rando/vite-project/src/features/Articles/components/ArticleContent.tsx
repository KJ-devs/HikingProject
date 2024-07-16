// components/Articlecontent.js

import React from "react";
import { Text } from "@mantine/core";
const ArticleContent = ({ content }: { content: string }) => {
  return (
    <Text size="sm" c="blue">
      {content}
    </Text>
  );
};

export default ArticleContent;
