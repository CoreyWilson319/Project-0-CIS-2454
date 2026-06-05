import Cart from "./Cart"
import {Link} from "react-router-dom"

function Navbar() {
    return (
        <div className="navbar">
            <Link to="/">
            <p>Fresh Mart</p>
            </Link>
            <Cart />
        </div>
    )
}

export default Navbar;