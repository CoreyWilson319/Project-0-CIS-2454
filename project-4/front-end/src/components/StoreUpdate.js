import { useParams, Link, useNavigate } from "react-router-dom";

function StoreUpdate({store}) {
  
  const navigate = useNavigate();
  const { id } = useParams()

  async function handleSubmit(e) {
    e.preventDefault();
    const name = e.target.elements.name.value;

  async function apiCall() {

    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/stores.php", {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          "id": id,
          "name": name})
      })

      navigate("/stores")
    } 

    catch {
      console.log("Error");
    }
  }

  apiCall();
  
}

  return (
    <form onSubmit={handleSubmit}>

      <label>Name:</label>
      <input name="name"></input>

      <button type='submit'>Submit</button>
    </form>
  );
}

export default StoreUpdate;
