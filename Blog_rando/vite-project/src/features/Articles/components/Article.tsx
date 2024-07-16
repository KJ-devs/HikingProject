import ArticleTitle from "./ArticleTitle";
import ArticleContent from "./ArticleContent";
import ArticleImages from "./ArticleImages";
import { Article } from "../hooks/useArticles";

export interface ArticleProps {
  article: Article;
}

function ArticleComponent({ article }: ArticleProps) {
  return (
    <div className="article bg-slate-500 border border-sky-500">
      <ArticleTitle title={article.title} />
      <ArticleContent content={article.content} />
      <ArticleImages images={article.photos} />
      {/* Assuming article.photos contains the base64 encoded images */}
    </div>
  );
}

export default ArticleComponent;
