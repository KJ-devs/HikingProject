// components/Article.tsx

import React from "react";
import ArticleTitle from "./ArticleTitle";
import ArticleDescription from "./ArticleDescription";
import ArticleImages from "./ArticleImages";
interface Image {
  url: string;
  alt: string;
}

export interface ArticleProps {
  article: {
    title: string;
    description: string;
    images: Image[]; // Assuming Image interface is defined similarly as in ArticleImages.tsx
  };
}

const Article: React.FC<ArticleProps> = ({ article }) => {
  return (
    <div className="article bg-slate-500 border border-sky-500">
      <ArticleTitle title={article.title} />
      <ArticleDescription description={article.description} />
      <ArticleImages images={article.images} />
      {/* Other components or content related to the article */}
    </div>
  );
};

export default Article;
