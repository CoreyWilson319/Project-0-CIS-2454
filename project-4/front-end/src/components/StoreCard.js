import { Routes, Route, BrowserRouter, useNavigate, Link } from "react-router-dom";
import AddStoreFormUpdate from "./StoreUpdate";
import AddStoreForm from "./AddStoreForm";

function StoreCard({store, onDelete}) {
  const navigate = useNavigate();

  async function handleClickSubmit(){
  async function apiCall() {

    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/stores.php", {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({"id": store.id})
      })
      onDelete(store.id)
    } 
    catch {
      console.log("Error");
    }

  }
  await apiCall();

  }

  return (
    <div>
      <div className="store-card">
        <div>
          <div className="store-card-title">{store.name}</div>
        </div>
        {/* <div className="store-card-content">Store ID:</div><div>{store.id}</div> */}
        <div className="store-card-content">
          <button onClick={handleClickSubmit}>Delete</button>
          </div>
        <div className="store-card-content">
          <Link to={"/stores/update/"+store.id}>
            <button>Update</button>
          </Link>
        </div>
        <div className="store-card-content">
          <Link to={"/add/"+store.id}>
            <button>Add Item</button>
          </Link>
        </div>
        <div className="store-card-content">
          <Link to={`/stores/${store.id}`}>
            <button>Shop</button>
          </Link>
        </div>
        </div>
        </div>
  );
}

export default StoreCard;
