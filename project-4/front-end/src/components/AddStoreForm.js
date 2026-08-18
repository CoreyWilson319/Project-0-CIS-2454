function AddStoreForm() {

  async function handleSubmit(e) {
    e.preventDefault();
    const name = e.target.elements.name.value;

  async function apiCall() {

    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/stores.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({"name": name})
      })
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
      <button type="submit">Submit</button>
    </form>
  );
}

export default AddStoreForm;
