import React from "react";
import NavBar from "../components/navbar/Navbar";
import Article, { ArticleProps } from "../features/Articles/components/Article"; // Assurez-vous d'importer ArticleProps depuis le composant Article

function Home() {
  // Exemple de données pour 10 articles différents
  const articles: ArticleProps["article"][] = [
    {
      title: "Article 1",
      description: "Description de l'article 1",
      images: [
        {
          url: "https://m.media-amazon.com/images/I/71Znma5NhsL._AC_UF1000,1000_QL80_.jpg",
          alt: "Image 1",
        },
      ],
    },
    {
      title: "Article 2",
      description: "Description de l'article 2",
      images: [{ url: "https://example.com/image3.jpg", alt: "Image 3" }],
    },
    {
      title: "Article 3",
      description: "Description de l'article 3",
      images: [
        { url: "https://example.com/image5.jpg", alt: "Image 5" },
        { url: "https://example.com/image6.jpg", alt: "Image 6" },
      ],
    },
    {
      title: "Article 4",
      description: "Description de l'article 4",
      images: [
        { url: "https://example.com/image7.jpg", alt: "Image 7" },
        { url: "https://example.com/image8.jpg", alt: "Image 8" },
      ],
    },
    {
      title: "Article 5",
      description: "Description de l'article 5",
      images: [
        { url: "https://example.com/image9.jpg", alt: "Image 9" },
        { url: "https://example.com/image10.jpg", alt: "Image 10" },
      ],
    },
    {
      title: "Article 6",
      description: "Description de l'article 6",
      images: [
        { url: "https://example.com/image11.jpg", alt: "Image 11" },
        { url: "https://example.com/image12.jpg", alt: "Image 12" },
      ],
    },
    {
      title: "Article 7",
      description: "Description de l'article 7",
      images: [
        { url: "https://example.com/image13.jpg", alt: "Image 13" },
        { url: "https://example.com/image14.jpg", alt: "Image 14" },
      ],
    },
    {
      title: "Article 8",
      description: "Description de l'article 8",
      images: [
        { url: "https://example.com/image15.jpg", alt: "Image 15" },
        { url: "https://example.com/image16.jpg", alt: "Image 16" },
      ],
    },
    {
      title: "Article 9",
      description: "Description de l'article 9",
      images: [
        { url: "https://example.com/image17.jpg", alt: "Image 17" },
        { url: "https://example.com/image18.jpg", alt: "Image 18" },
      ],
    },
    {
      title: "Article 10",
      description: "Description de l'article 10",
      images: [
        { url: "https://example.com/image19.jpg", alt: "Image 19" },
        { url: "https://example.com/image20.jpg", alt: "Image 20" },
      ],
    },
  ];

  return (
    <>
      <NavBar />
      <div className="articles-container">
        {articles.map((article, index) => (
          <Article key={index} article={article} />
        ))}
      </div>
    </>
  );
}

export default Home;
