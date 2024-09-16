const {mongoose} = require('../services/db')

const { Schema } = mongoose

const productSchema = new Schema({
    description: String,
    inStock: Boolean,
    name: String,
    price: Number,           
})

const Product = mongoose.model("product", productSchema)

//Function
function createProduct({description, inStock, name, price}) {
    const product = new Product({
        description,
        inStock,
        name,
        price
    })
    return product.save()
}

function getProducts() {
    return Product.find({})
}

function getProduct(id) {
    return Product.findById(id)
}

function updateProduct(id, newValues) {
    return Product.replaceOne({_id: id}, {...newValues, _id: id})
}

function deleteProduct(_id) {
    return Product.deleteOne({_id})
}

module.exports = {createProduct, getProducts, getProduct, updateProduct, deleteProduct}