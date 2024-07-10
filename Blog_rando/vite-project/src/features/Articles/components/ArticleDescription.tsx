// components/ArticleDescription.js

import React from "react";

const ArticleDescription = ({ description }: { description: string }) => {
  return <p className="article-description ">{description}</p>;
};

export default ArticleDescription;
