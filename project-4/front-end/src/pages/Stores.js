import StoreCard from "../components/StoreCard";
import {useState, useEffect} from 'react';
const apiUrl = process.env.REACT_APP_API_URL;
function Browse(props) {

  const [stores, setStores] = useState([]);

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
  const mapped_stores = stores.map((store) => <StoreCard key={store.id} store={store}/>)
  return (
    <div className="browse">
      {/* show stores belonging to a particular store */}
      {/* Create a new page? */}
      {/* Use a dropdown to select the store */}
      {mapped_stores}
    </div>
  );
}

export default Browse;
