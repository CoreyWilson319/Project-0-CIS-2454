import { useParams } from "react-router-dom";

function ItemUpdate({store}) {

  const { id } = useParams()

  async function handleSubmit(e) {
    e.preventDefault();
    const name = e.target.elements.name.value;
    const quantity = e.target.elements.quantity.value;
    const storeID = e.target.elements.storeID.value;
    const checked = e.target.elements.checked.checked;

  async function apiCall() {

    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/items.php/"+id, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          "id": id,
          "store_id": storeID,
          "name": name,
          "quantity": quantity,
          "checked": checked,
        })
      })
      console.log(response)

    } 
    catch {
      console.log("Error");
    }
  }

  apiCall();
  
}

  return (
    <form onSubmit={handleSubmit}>
      <label>Store ID:</label>
      <input name="storeID"></input>

      <label>Name:</label>
      <input name="name"></input>

      <label>Quantity:</label>
      <input name="quantity"></input>

      <label>Checked?:</label>
      <input type='checkbox' name="checked"></input>

      <button type='submit'>Submit</button>
    </form>
  );
}

export default ItemUpdate;
