import { useNavigate } from "react-router-dom";

function AddStoreForm() {
  const navigate = useNavigate();

  async function handleSubmit(e) {
    e.preventDefault();

    const name = e.target.elements.name.value;
    const apiUrl = process.env.REACT_APP_API_URL;

    try {
      const response = await fetch(apiUrl + "backend/stores.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          name: name
        })
      });

      navigate("/stores");

    } catch (error) {
      console.log("Error:", error);
    }
  }

  // navigate("/stores")


  return (
    <form onSubmit={handleSubmit} className="item-form">
      <div className="form-content">
      <label>Name:</label>
      </div>
    
      <input name="name"></input>
    <div className="form-content">
      <button type="submit">Submit</button>
      </div>
    </form>
  );
}

export default AddStoreForm;
