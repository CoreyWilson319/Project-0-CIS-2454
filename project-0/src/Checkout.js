import { useState } from "react"
import ProductCard from "./ProductCard"
import { BrowserRouter, Routes, Route, Link } from "react-router-dom"

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

         <div className="purchasing-card">
             <p>Purchasing</p>
             <p>{props.name.toUpperCase()}</p>
             <img src={"/"+props.name+".jpg"} />
             <p>Total: ${props.cost}</p>
        </div>
            </div>

        <form className="checkout-form" 
         onSubmit={(e) => {
            if (goodForm) {
                handleClick(e)
            } else {
                alert("Invalid Card Number");
            }
        }}>
            <label>Name: </label><input label="name" name="name"  type="text"></input>
            <label>Card Number: </label><input label="card" name="card" onChange={handleChange} type="text"></input>
            <label>CVC: </label><input label="cvc" name="cvc"  type="text"></input>
            <label>Expiration Date: </label><input label="expiration-date" name="expiration-date" type="month"></input>
            <label>Billing Address: </label><input label="billing-address" name="billing-address" type="text"></input>
            <label>Shipping Address: </label><input label="shipping-address" name="shipping-address" type="text"></input>
            <div id="buttons">
                <button id="checkout-button" type="submit">Submit</button>
                <a id="cancel-button" href="/">Cancel</a>
            </div>
        </form>
        
        </>
    )
}

export default Checkout;