import landing from "../landing/landing.jpg";

function Home() {
  return (
    <div className="home">
      <img id="image" src={landing}></img>
      <a id="enter-link" href="/browse">Click to Enter!</a>
    </div>
  );
}

export default Home;
