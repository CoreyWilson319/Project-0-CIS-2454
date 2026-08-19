import ItemCard from "../components/ItemCard";
import StoreCard from "../components/StoreCard";
import {useState, useEffect} from 'react';
import {useParams} from 'react-router-dom';
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
      {mapped_items}
    </div>
  );
}

export default ShopStore;
