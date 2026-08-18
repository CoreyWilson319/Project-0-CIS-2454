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
    <form onSubmit={handleSubmit}>
      <label>Name:</label>
      <input name="name"></input>
      <button type="submit">Submit</button>
    </form>
  );
}

export default AddStoreForm;
