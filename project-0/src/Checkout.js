import { useState } from "react"

function Checkout(props) {

    const [goodForm, setGoodForm] = useState(false)
    const [card, setCard] = useState("")

    function handleChange(e) {
        let tempCard = e.target.value

        if (tempCard.length === 16) {
            setGoodForm(true)
        } else {
            setGoodForm(false)
        }
        setCard(tempCard)
    }

    function handleClick(e) {
        e.preventDefault();
        setForm(e)

    }
    function setForm(e){
        const formData = new FormData(e.target)
        const data = Object.fromEntries(formData.entries())
    }
    return (
        <>
            <p className="title">Item Being Purchased</p>
         <div className="checkout-items">
             <p>Item Being Purchased</p>
             <p>Item: {props.name}</p>
             <p>Total: ${props.cost}</p>
        </div>

        <form className="checkout-form" 
         onSubmit={(e) => {
            if (goodForm) {
                handleClick(e)
            } else {
                alert("Invalid Card Number");
            }
        }}>
            <label for="name">Name: </label><input label="name" name="name"  type="text"></input>
            <label for="card">Card Number: </label><input label="card" name="card" onChange={handleChange} type="text"></input>
            <label for="cvc">CVC: </label><input label="cvc" name="cvc"  type="text"></input>
            <label for="expiration-date">Expiration Date: </label><input label="expiration-date" name="expiration-date" type="date"></input>
            <label for="billing-address">Billing Address: </label><input label="billing-address" name="billing-address" type="text"></input>
            <label for="shipping-address">Shipping Address: </label><input label="shipping-address" name="shipping-address" type="text"></input>
            <button id="checkout-button" type="submit">Submit</button>
        </form>
        </>
    )
}

export default Checkout;