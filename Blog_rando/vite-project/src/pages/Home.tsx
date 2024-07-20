import React from "react";
import NavBar from "../components/navbar/Navbar";
import ArticleList from "../features/Articles/components/ArticlesList";
import { MantineProvider } from "@mantine/core";
function Home() {
  return (
    <>
      <NavBar />
      <div className="App">
        <ArticleList />
      </div>
    </>
  );
}

export default Home;
