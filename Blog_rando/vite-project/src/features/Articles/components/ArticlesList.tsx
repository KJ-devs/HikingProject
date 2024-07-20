import React from "react";
import ArticleComponent from "./Article";
import useArticles from "../hooks/useArticles";
import { LoadingOverlay, Box, Container } from "@mantine/core";
import { useDisclosure } from "@mantine/hooks";

interface ArticleListProps {}

const ArticleList: React.FC<ArticleListProps> = () => {
  const { articles, loading, error } = useArticles();
  const [isOpen] = useDisclosure();

  if (loading) {
    return (
      <Box pos="relative">
        <LoadingOverlay
          visible={isOpen}
          zIndex={1000}
          overlayProps={{ radius: "sm", blur: 2 }}
        />
        {/* ...other content */}
      </Box>
    );
  }

  if (error) {
    return <div>Error: {error.message}</div>;
  }

  return (
    <Container
      style={{
        display: "flex",
        flexDirection: "column",
        alignItems: "center",
        justifyContent: "center",
        padding: "20px",
      }}
    >
      {articles.map((article) => (
        <Box
          key={article.id}
          style={{
            marginBottom: "20px",
            width: "100%",
            maxWidth: "600px",
          }}
        >
          <ArticleComponent article={article} />
        </Box>
      ))}
    </Container>
  );
};

export default ArticleList;
