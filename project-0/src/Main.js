import './App.css';
import {Route, Routes} from "react-router-dom"
import Browser from "./Browser"
import Navbar from "./Navbar"
import Landing from "./Landing"
import Checkout from "./Checkout"

function Main(props) {
  return (
    <>
    <div className="App">
      <Navbar />

      <Routes>
        <Route element={<Browser root = {props.root}/>} path="browse"/>
        <Route element={<Landing />} path="/" />
      </Routes>
    </div>
    </>

  );
}

export default Main;
