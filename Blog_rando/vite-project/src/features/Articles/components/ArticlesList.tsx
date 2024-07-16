// components/ArticleList.tsx

import React from "react";
import ArticleComponent from "./Article";
import useArticles from "../hooks/useArticles"; // Import useArticles hook

interface ArticleListProps {}

const ArticleList: React.FC<ArticleListProps> = () => {
  const { articles, loading, error } = useArticles();

  if (loading) {
    return <div>Loading...</div>;
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
