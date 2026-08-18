import { Routes, Route, BrowserRouter } from "react-router-dom";
import Home from "./pages/Home";
import Browse from "./pages/Browse";
import Stores from "./pages/Stores";
import Add from "./pages/Add";
import ItemUpdate from "./components/ItemUpdate";
import ShopStore from "./pages/ShopStore";
import Header from "./components/Header";
import Footer from "./components/Footer";
import StoreUpdate from "./components/StoreUpdate";
// import ItemUpdate from "./components/ItemUpdate";
import logo from './logo.svg';
import './App.css';

function App(props) {
  return (
    <div className="page">
    <Header />
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/browse" element={<Browse />} />
        <Route path="/add" element={<Add />} />
        <Route path="/add/:id" element={<Add />} />
        <Route path="/stores" element={<Stores />} />
        <Route path="/stores/update/:id" element={<StoreUpdate/>} />
        <Route path="/stores/:id" element={<ShopStore/>} />
        <Route path="/items/update/:id" element={<ItemUpdate/>} />
      </Routes>
    </BrowserRouter>
    <Footer />
    </div>
  );
}

export default App;
