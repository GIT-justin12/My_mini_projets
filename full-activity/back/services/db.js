//Mongoose
const mongoose = require("mongoose")
const uri = 'mongodb://localhost:27017/crud'
mongoose.connect(uri).then(() => console.log("Connecté à la base"))
.catch((err) => console.error(err))

module.exports = {mongoose}