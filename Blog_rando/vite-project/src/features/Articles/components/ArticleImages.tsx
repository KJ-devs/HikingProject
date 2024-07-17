import React from "react";
import { Image } from "@mantine/core";
import { Carousel } from "@mantine/carousel";

export interface ImageProps {
  imageBlob: string;
}

interface ArticleImagesProps {
  images: ImageProps[];
}

const ArticleImages: React.FC<ArticleImagesProps> = ({ images }) => {
  return images.length === 0 ? null : (
    <Carousel
      withIndicators
      slideSize="70%"
      height={200}
      slideGap="md"
      controlsOffset="xs"
      dragFree
    >
      {images.map((image, index) => (
        <Carousel.Slide key={index}>
          <Image
            src={`data:image/jpeg;base64,${image.imageBlob}`}
            h={150} // Ensure the image height matches the carousel height
            fit="contain"
            alt={`Image ${index + 1}`}
          />
        </Carousel.Slide>
      ))}
    </Carousel>
  );
};

export default ArticleImages;
