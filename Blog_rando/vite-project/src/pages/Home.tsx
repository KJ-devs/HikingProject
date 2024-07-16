import React from "react";
import NavBar from "../components/navbar/Navbar";
import ArticleList from "../features/Articles/components/ArticlesList";

function Home() {
  return (
    <>
      <NavBar />
      <div className="articles-container">
        <ArticleList />
        {/* Pass fetched articles to ArticleList */}
      </div>
    </>
  );
}

export default Home;
