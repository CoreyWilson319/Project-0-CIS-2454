import fruits from "../src/resources/landing.jpg"
import {Link} from "react-router-dom"


function Landing() {
  return (
    <>
    <div className="landing">
      <h1>Welcome to Fresh Mart!</h1>
      <img src={fruits}/>
      <Link to="/browse"><button className="browse-btn">Browse</button></Link>
    </div>
    
    </>
  );
}

export default Landing;
