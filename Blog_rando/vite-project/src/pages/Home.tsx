import React from "react";
import NavBar from "../components/navbar/Navbar";
import ArticleList from "../features/Articles/components/ArticlesList";
import useArticles from "../features/Articles/hooks/useArticles"; // Import useArticles hook

function Home() {
  const { articles, loading, error } = useArticles(); // Fetch articles using useArticles hook

  if (loading) {
    return <div>Loading...</div>; // Show loading indicator while fetching data
  }

  if (error) {
    return <div>Error: {error.message}</div>; // Show error message if fetch fails
  }

  return (
    <>
      <NavBar />
      <div className="articles-container">
        <ArticleList articles={articles} />
        {/* Pass fetched articles to ArticleList */}
      </div>
    </>
  );
}

export default Home;
