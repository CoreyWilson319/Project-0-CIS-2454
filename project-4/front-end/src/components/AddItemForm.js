import {useState, useEffect} from 'react';
import { useNavigate, useParams } from "react-router-dom";


function AddItemForm() {
  const navigate = useNavigate();
  const { id } = useParams();



async function handleSubmit(e) {
  e.preventDefault();
    const storeID = e.target.elements.storeID.value;
    const name = e.target.elements.name.value;
    const quantity = e.target.elements.quantity.value;
    let checked = e.target.elements.checked.checked;

  async function apiCall() {

    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/items.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({"store_id": storeID, "name": name, "quantity": quantity, "checked": checked})
      })

      navigate("/stores");
    } 
    catch {
      console.log("Error");
    }
  }

  apiCall();
  
}

  return (
    <form onSubmit={handleSubmit} className='item-form'>
      {id !== undefined ? (<input type="hidden" name="storeID" value={id}/>) : (
        <>
      <div className='form-content'>
        <label>Store ID:</label>
      </div>
        <input name="storeID"></input>
           </>
      
      )}

      <div className='form-content'>
        <label>Name:</label>
      </div>
        <input name="name"></input>

      <div className='form-content'>
        <label>Quantity:</label>
      </div>
        <input name="quantity"></input>

      <div className='form-content'>
        <label>Checked?:</label>
      </div>
        <input type='checkbox' name="checked"></input>
        <button type='submit'>Submit</button>
    </form>
  );
}

export default AddItemForm;
