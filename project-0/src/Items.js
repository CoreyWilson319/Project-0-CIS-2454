import Item from "./Item"

function Items(props) {
    // const root = {...prop}
    // console.log(root)
    let availableItems = [
        {"name": "apple", "cost": "0.25", "id": 1},
        {"name": "kiwi", "cost": "0.35", "id": 2},
        {"name": "orange", "cost": "0.30", "id": 3},
        {"name": "pear", "cost": "0.40", "id": 4},
        {"name": "banana", "cost": "0.20", "id": 5},
        {"name": "coconut", "cost": "1.00", "id": 6}
    ]
    return (
        <div className = "item-container">
        {availableItems.map((item) => {
            return(<Item key={item.id} name={item.name} cost={item.cost} root = {props.root}/>)
        })}
        </div>
    )
}

export default Items;