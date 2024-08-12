import React from "react";
import NavBar from "../components/navbar/Navbar";
import ArticleList from "../features/Articles/components/ArticlesList";
import { MantineProvider } from "@mantine/core";
import Chat from "./Chat";
function Home() {
  return (
    <>
      <NavBar />
      <div className="App">
        <Chat />
      </div>
    </>
  );
}

export default Home;
