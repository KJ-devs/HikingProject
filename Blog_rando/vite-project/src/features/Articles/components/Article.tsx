import ArticleTitle from "./ArticleTitle";
import ArticleContent from "./ArticleContent";
import ArticleImages from "./ArticleImages";
import { Article } from "../hooks/useArticles";
import { Card, Group } from "@mantine/core";
import { Carousel } from "@mantine/carousel";
import ArticleProfil from "./ArticleProfil";

export interface ArticleProps {
  article: Article;
}

function ArticleComponent({ article }: ArticleProps) {
  return (
    <Card
      shadow="md"
      padding="mg"
      radius="md"
      withBorder
      style={{
        backgroundColor: "#2E8B57",
        borderColor: "#006400",
        color: "#F5FFFA",
      }}
    >
      <Group>
        <ArticleProfil />

        <ArticleTitle title={article.title} createdAt={article.createdAt} />
      </Group>
      <Card.Section>
        <ArticleImages images={article.photos} />
      </Card.Section>
      <ArticleContent content={article.content} />
    </Card>
  );
}

export default ArticleComponent;
