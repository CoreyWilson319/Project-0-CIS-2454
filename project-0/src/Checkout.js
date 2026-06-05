function Checkout(props) {
    return (
        // <div className="checkout-items">
        //     <p>Item Being Purchased</p>
        //     <p>{props.name}</p>
        //     <p>{props.cost}</p>
        // </div>
        <>
            <p className="title">Item Being Purchased</p>
        <div className="checkout-items">
            <p>Item: Apple</p>
            <p>Total: $0.25</p>
        </div>
        <form className="checkout-form">
            <label for="name">Name: </label><input label="name" type="text"></input>
            <label for="card">Card Number: </label><input label="card" type="text"></input>
            <label for="cvc">CVC: </label><input label="cvc" type="text"></input>
            <label for="expiration-date">Expiration Date: </label><input label="expiration-date" type="text"></input>
            <label for="billing-address">Billing Address: </label><input label="billing-address" type="text"></input>
            <label for="shipping-address">Shipping Address: </label><input label="shipping-address" type="text"></input>
            <button id="checkout-button" type="submit">Submit</button>
        </form>
        </>
    )
}

export default Checkout;