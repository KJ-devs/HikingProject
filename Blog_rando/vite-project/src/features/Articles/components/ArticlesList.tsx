// components/ArticleList.tsx

import React from "react";
import ArticleComponent, { Article } from "./Article";

interface ArticleListProps {
  articles: Article[];
}

const ArticleList: React.FC<ArticleListProps> = ({ articles }) => {
  return (
    <div className="article-list">
      {articles.map((article, index) => (
        <ArticleComponent key={index} article={article} />
      ))}
    </div>
  );
};

export default ArticleList;
