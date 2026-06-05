import {Link} from "react-router-dom"
import Checkout from "./Checkout"
function Item(props) {
    function handleClick() {
        // Render Checkout Component?
        
        props.root.render(<Checkout name={props.name} cost={props.cost} id={props.id}/>)
    }
    return (
        <div className="item">
                <p>{props.name.toUpperCase()}</p><p>{props.cost}</p>
            <div className="item-button">
                    <button onClick={() => handleClick()}>Buy</button>
            </div>
        </div>
    )
}

export default Item;