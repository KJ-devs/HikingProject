// ArticleImages.tsx

import React from "react";

export interface Image {
  imageBlob: string;
}

interface ArticleImagesProps {
  images: Image[];
}

const ArticleImages: React.FC<ArticleImagesProps> = ({ images }) => {
  return (
    <div className="article-images">
      {images.map((image, index) => (
        <img
          key={index}
          src={`data:image/jpeg;base64,${image.imageBlob}`} // Assuming your images are JPEG, adjust if needed
          alt={`Image ${index}`}
          className="max-w-64 max-h-40 rounded-lg"
        />
      ))}
    </div>
  );
};

export default ArticleImages;
