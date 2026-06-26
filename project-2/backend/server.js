const express = require("express");
const app = express();
const market = require("./market.json")

app.get('/items', (req, res) => {
    res.send(market.items)
})

app.post('/items/:item', (req, res) => {
    let searchItem = market.items.find(item => item === req.params.item)
    if (searchItem) {
        res.status(400).send(`${req.params.item} already exists!`)
    } else {
        market.items.push(req.params.item)
        res.status(200).send(`${req.params.item} added!`)
    }
})

app.delete('/items/:item', (req, res) => {
    let searchItem = market.items.find(item => item === req.params.item)
    if (searchItem) {
        let modifiedItems = market.items.filter(item => item !== req.params.item)
        market.items = modifiedItems
        res.status(200).send(market.items)
    } else {
        res.status(400).send(`${req.params.item} not found!`)
    }

})
app.put('/staffing/:number', (req, res) => {
    if (req.params.number > 0) {
        market.numberOfStaff = req.params.number
        res.status(200).send("Successfuly updated the number of staffing to " + req.params.number)
    } else {
        res.status(400).send("Invalid Number of Staff Entered")
    }
})

app.get('/staffing/', (req, res) => {
    res.status(200).send(market.numberOfStaff)
})



const port = 8080;


try {
    app.listen(port)
    console.log("Listening on port " + port)
} catch {
    console.log("Error")
}