import { Routes, Route, BrowserRouter } from "react-router-dom"
import Home from "./pages/Home"
import Taskbar from "./components/Taskbar"
import logo from './logo.svg';
import './App.css';

function App() {
  return (
    <>
    <BrowserRouter>
      <Routes>
        <Route path="*" element={<Taskbar />} />
        <Route path="/" element={<Home />} />
      </Routes>
    </BrowserRouter>
    <Taskbar/>
    </>
  );
}

export default App;
