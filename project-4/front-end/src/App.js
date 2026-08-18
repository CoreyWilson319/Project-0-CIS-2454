import { Routes, Route, BrowserRouter } from "react-router-dom";
import Home from "./pages/Home";
import Browse from "./pages/Browse";
import Add from "./pages/Add";
import Header from "./components/Header";
import Footer from "./components/Footer";
import logo from './logo.svg';
import './App.css';

function App() {
  return (
    <div className="page">
    <Header />
    <BrowserRouter>
      <Routes>
        {/* <Route path="*" element={<Taskbar />} /> */}
        <Route path="/" element={<Home />} />
        <Route path="/browse" element={<Browse />} />
        <Route path="/add" element={<Add />} />
      </Routes>
    </BrowserRouter>
    <Footer />
    </div>
  );
}

export default App;
