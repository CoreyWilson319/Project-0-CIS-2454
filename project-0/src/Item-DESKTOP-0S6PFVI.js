import {Link} from "react-router-dom"
function Item(props) {
    return (
        <div className="item">
                <p>{props.name.toUpperCase()}</p><p>${props.cost}</p>
            <div className="item-button">
                <Link to="/checkout">
                    <button >Buy</button>
                </Link>
            </div>
        </div>
    )
}

export default Item;