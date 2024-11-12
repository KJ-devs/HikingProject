import { Badge, Group, Text } from "@mantine/core";

const ArticleTitle = ({
  title,
  createdAt,
}: {
  title: string;
  createdAt: string;
}) => {
  return (
    <Group mt="md" mb="xs" style={{ padding: "0px 0px 0px 14px" }}>
      <Text fw={700} c="#FFCC00" style={{ fontSize: "1.5em" }}>
        {title}
      </Text>
      <Text size="md" c="#FAF5E9">
        {createdAt}
      </Text>
      <Badge color="white" variant="light">
        News
      </Badge>
    </Group>
  );
};

export default ArticleTitle;
