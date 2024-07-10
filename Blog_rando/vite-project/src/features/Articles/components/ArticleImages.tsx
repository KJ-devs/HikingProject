// components/ArticleImages.tsx

import React from "react";

interface Image {
  url: string;
  alt: string;
}

interface ArticleImagesProps {
  images: Image[];
}

const ArticleImages: React.FC<ArticleImagesProps> = ({ images }) => {
  return (
    <div className="article-images">
      {images.map((image, index) => (
        <img
          className="max-w-64 max-h-40 rounded-lg"
          key={index}
          src={image.url}
          alt={image.alt}
        />
      ))}
    </div>
  );
};

export default ArticleImages;
