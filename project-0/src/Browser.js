import Items from "./Items"
function Browser(props) {
    return (
        <div>
            <p className="title">Market Items</p>
            <Items root = {props.root} ></Items>
        </div>
    )
}

export default Browser;