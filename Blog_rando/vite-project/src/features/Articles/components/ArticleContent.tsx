// components/Articlecontent.js

import React from "react";

const ArticleContent = ({ content }: { content: string }) => {
  return <p className="article-content ">{content}</p>;
};

export default ArticleContent;
