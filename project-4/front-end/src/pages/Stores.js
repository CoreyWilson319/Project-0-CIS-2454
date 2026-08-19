import StoreCard from "../components/StoreCard";
import {useState, useEffect} from 'react';
const apiUrl = process.env.REACT_APP_API_URL;
function Stores(props) {

  const [stores, setStores] = useState([]);

  function handleDelete(id) {
    setStores(stores.filter(store => store.id !== id));
  }

  useEffect(() => {
    async function fetchData() {

      try {
        const response = await fetch(apiUrl + "backend/stores.php")
        const results = await response.json();
        await setStores(results)
      } 
      catch {
        console.log("Error");
      }
    };
  
      fetchData() 
}, [])
  const mapped_stores = stores.map((store) => <StoreCard key={store.id} store={store} onDelete={handleDelete}/>)
  return (
    <div className="browse">
      {mapped_stores}
    </div>
  );
}

export default Stores;
