import ArticleTitle from "./ArticleTitle";
import ArticleContent from "./ArticleContent";
import ArticleImages from "./ArticleImages";
import { Article } from "../hooks/useArticles";
import { Card } from "@mantine/core";
import { Carousel } from "@mantine/carousel";

export interface ArticleProps {
  article: Article;
}

function ArticleComponent({ article }: ArticleProps) {
  return (
    <Card shadow="sm" padding="lg" radius="md" withBorder>
      <ArticleTitle title={article.title} />
      <ArticleContent content={article.content} />
      <Card.Section>
        <ArticleImages images={article.photos} />
        {/* Assuming article.photos contains the base64 encoded images */}
      </Card.Section>
    </Card>
  );
}

export default ArticleComponent;
