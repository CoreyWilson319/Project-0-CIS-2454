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
    <div className="add">
      <form onSubmit={handleSubmit} className="item-form">
      <p>Update a Store</p>

        <div className="form-content">
          <label>Name:</label>
        </div>
          <input name="name"></input>

        <div className="form-content">
          <button type='submit'>Submit</button>
        </div>
      </form>
    </div>
  );
}

export default StoreUpdate;
