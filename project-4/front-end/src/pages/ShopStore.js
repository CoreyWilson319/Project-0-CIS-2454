import ItemCard from "../components/ItemCard";
import StoreCard from "../components/StoreCard";
import {useState, useEffect} from 'react';
import {useParams} from 'react-router-dom';
// import { useNavigate } from "react-router-dom";
// const navigate = useNavigate();
// navigate("/");
const apiUrl = process.env.REACT_APP_API_URL;




function ShopStore({ store, handleDelete}) {
  const { id } = useParams();
  const [items, setItems] = useState([]);

  useEffect(() => {
    async function fetchData() {

      try {
        const response = await fetch(apiUrl + "backend/stores.php?id=" + id)
        const results = await response.json();
        await setItems(results)
      } 
      catch {
        console.log("Error");
      }
    };
  
      fetchData() 
}, [])
  const mapped_items = items.map((item) => <ItemCard key={item.id} item={item} onDelete={handleDelete}/>)

  return (
    <div className="browse">
      {/* show items belonging to a particular store */}
      {/* Create a new page? */}
      {/* Use a dropdown to select the store */}
      {mapped_items}
    </div>
  );
}

export default ShopStore;
