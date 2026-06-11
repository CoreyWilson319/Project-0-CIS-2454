import {Link} from "react-router-dom"
import Checkout from "./Checkout"
function ProductCard(props) {
    function handleClick() {
        props.root.render(<Checkout name={props.name} cost={props.cost} id={props.id}/>)
    }
    return (
        <div className="card">
                <p>{props.name.toUpperCase()}</p><p>${props.cost}</p>
                <button className="buy-button" onClick={() => handleClick()}>Buy</button>
        </div>
    )
}

export default ProductCard;
