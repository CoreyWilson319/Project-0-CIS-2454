import { Link, useParams } from "react-router-dom";

function ItemCard({item, onDelete}) {

  const { storeID } = useParams();
  async function handleClick(){
  async function apiCall() {

    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/items.php", {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({"id": item.id})
      })
      onDelete(item.id)
    } 

    catch (error) {
      console.log(error);
    }
  }

  await apiCall();

  
  }
  return (
    <div>
      <div className="item-card">
        <div className="card-content">Name:</div><div>{item.name}</div>
        <div className="card-content">Quantity:</div><div>{item.quantity}</div>
        <div className="card-content">Store ID:</div><div>{item.store_id}</div>
        <div className="card-content">Checked:</div><div>{item.checked}</div>
        <div className="card-content"><button onClick={handleClick}>Delete</button></div>
          <Link to={`/stores/${item.store_id}/items/${item.id}/update`}>
            <button>Update</button>
          </Link>
      </div>
    </div>
  );
}

export default ItemCard;
