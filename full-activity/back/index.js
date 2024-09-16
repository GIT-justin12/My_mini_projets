const expess = require("express")
const cors = require('cors')
const bodyParser = require('body-parser')
const {createProduct, getProducts, getProduct, updateProduct, deleteProduct} = require('./models/Product')

const app = expess()
const port = 3000

//Middlewares
app.use(cors())
app.use(bodyParser.json())

//Routes
app.post('/api/products', async (req, res) => {
    //res.setHeader("Access-Control-Allow-Origin", "*")

    try {
        const result = await createProduct(req.body)
        res.send({"product": result})
    } catch(err) {
        console.err(err)
    }
})

app.get('/api/products', async (req, res) => {
    try {
        products = await getProducts()
        console.log(products)
        res.send({products})
    } catch(err) {
        console.err(err)
    }
})

app.get('/api/products/:id', async (req, res) => {
    try {
        const id = req.params.id
        product = await getProduct(id)
        console.log(product)
        res.send({product})
    } catch(err) {
        console.err(err)
    }
})

app.put('/api/products/:id', async (req, res) => {
    try {
        const id = req.params.id
        product = await updateProduct(id, req.body)
        console.log(product)
        res.send({product})
    } catch(err) {
        console.err(err)
    }
})

app.delete('/api/products/:id', async (req, res) => {
    try {
        const id = req.params.id
        product = await deleteProduct(id)
        console.log(product)
        res.send({message: "Deleted!"})
    } catch(err) {
        console.err(err)
    }
})
  
app.listen(port, () => {
    console.log(`App listening on port ${port}`)
})