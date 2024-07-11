// features/Articles/components/Article.tsx

import React from "react";
import ArticleTitle from "./ArticleTitle";
import ArticleContent from "./ArticleContent";
// import ArticleImages from "./ArticleImages";

export interface Image {
  url: string;
  alt: string;
}

export interface Article {
  id: number;
  title: string;
  content: string;
  // images: Image[];
}

export interface ArticleProps {
  article: Article;
}

const ArticleComponent: React.FC<ArticleProps> = ({ article }) => {
  return (
    <div className="article bg-slate-500 border border-sky-500">
      <ArticleTitle title={article.title} />
      <ArticleContent content={article.content} />
      {/* <ArticleImages images={article.images} /> */}
    </div>
  );
};

export default ArticleComponent;
