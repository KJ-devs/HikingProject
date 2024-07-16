import React, { useCallback, useEffect, useState } from "react";
import { Image } from "@mantine/core";
import { Carousel, Embla } from "@mantine/carousel";
import { Progress } from "@mantine/core";
export interface ImageProps {
  imageBlob: string;
}

interface ArticleImagesProps {
  images: ImageProps[];
}

const ArticleImages: React.FC<ArticleImagesProps> = ({ images }) => {
  // const [scrollProgress, setScrollProgress] = useState(0);
  // const [embla, setEmbla] = useState<Embla | null>(null);

  // const handleScroll = useCallback(() => {
  //   if (!embla) return;
  //   const progress = Math.max(0, Math.min(1, embla.scrollProgress()));
  //   setScrollProgress(progress * 100);
  // }, [embla, setScrollProgress]);

  // useEffect(() => {
  //   if (embla) {
  //     embla.on("scroll", handleScroll);
  //   }
  // }, [embla]);

  return (
    <>
      <Carousel
        // getEmblaApi={setEmbla}
        h={150}
        // withIndicators
        // slideSize="70%"
        // slideGap="xs"
        // w={80}
        // orientation="horizontal"
        // style={{ backgroundColor: "red" }}
      >
        {images.map((image, index) => (
          <Carousel.Slide key={index}>
            <Image
              src={`data:image/jpeg;base64,${image.imageBlob}`}
              h={80}
              // fit="contain"
            />
          </Carousel.Slide>
        ))}
      </Carousel>
      {/* <Progress
        value={scrollProgress}
        color="blue"
        radius="xl"
        style={{ position: "absolute", bottom: 0, left: 0, right: 0 }}
      /> */}
    </>
  );
};

export default ArticleImages;
