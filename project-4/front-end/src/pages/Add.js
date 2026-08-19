import {useState} from 'react';
import AddItemForm from '../components/AddItemForm';
import AddStoreForm from '../components/AddStoreForm';

function Add() {

const [type, setType] = useState("item");

function handleChange(e) {
  e.preventDefault();
  setType(e.target.value);
}

  return (
    <div id="add">
      <p>Create an Item or Store</p>
      <form>
          <select name="addOption" onChange={handleChange}>
            <option value="item">Item</option>
            <option value="store">Store</option>
          </select>
        </form>
        { type == "item" ? <AddItemForm /> : <AddStoreForm />}         
    </div>
  );
}

export default Add;
