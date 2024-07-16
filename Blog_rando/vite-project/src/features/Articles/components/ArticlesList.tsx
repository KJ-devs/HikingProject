import React from "react";
import ArticleComponent from "./Article";
import useArticles from "../hooks/useArticles";
import { LoadingOverlay, Box } from "@mantine/core";
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
    <div className="article-list">
      {articles.map((article) => (
        <ArticleComponent key={article.id} article={article} />
      ))}
    </div>
  );
};

export default ArticleList;
