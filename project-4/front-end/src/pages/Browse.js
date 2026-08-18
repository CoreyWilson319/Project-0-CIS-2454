import ItemCard from "../components/ItemCard";
import {useState, useEffect} from 'react';
const apiUrl = process.env.REACT_APP_API_URL;
function Browse(props) {

  const [items, setItems] = useState([]);

  useEffect(() => {
    async function fetchData() {

      try {
        const response = await fetch(apiUrl + "backend/items.php")
        const results = await response.json();
        await setItems(results)
      } 
      catch {
        console.log("Error");
      }
    };
  
      fetchData() 
}, [])
  const mapped_items = items.map((item) => <ItemCard key={item.id} item={item}/>)
  return (
    <div className="browse">
      {/* show items belonging to a particular store */}
      {/* Use a dropdown to select the store */}
      {mapped_items}
    </div>
  );
}

export default Browse;
