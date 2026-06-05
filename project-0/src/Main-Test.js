import './App.css';
import {Route, Routes, Link} from "react-router-dom"
import Browser from "./Browser"
import Navbar from "./Navbar"
import Landing from "./Landing"

function Main() {
  return (
    <>
    <div className="App">
      <Navbar />

      <Routes>
        <Route element={<Browser />} path="/browse"/>
        <Route element={<Landing />} path="/" />
      </Routes>
    </div>
    </>

  );
}

export default Main;
