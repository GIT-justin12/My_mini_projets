const express = require('express');
const mysql      = require('mysql');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

// Etablish connection to database
db = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '',
    database : 'smdbschool'
});

db.connect(function (error) {
    if (error) {
        console.log("Error Connecting to DB");
    } else {
        console.log("Successfully connected to DB");
    }
});

// Etablish port
app.listen(3000, function check(error) {
    if (error)
    {
        console.log("Error !!!");
    }
    else {
        console.log("Start !!!");
    }
});

//  Create records
app.post("/api/student/add", (req, res) => {
    let details = {
        name: req.body.name,
        course: req.body.course,
        fee: req.body.fee,
    };

    let sql = "INSERT INTO student SET ?";

    db.query(sql, details, (error) => {
        if (error) {
            res.send({ status: false, message: "student created failed" });
            console.log(error);
        }
        else {
            res.send({ status: true, message: "Student created successfully" });
        }
    });
});

// View records
app.get("/api/student", (req, res) => {
    let sql = "SELECT * FROM student";
    db.query(sql, function (error, result) {
        if (error) {
            console.log("Error connecting to DB");
        } else {
            res.send({ status: true, data: result });
        }
    });
});

// search records
app.get("/api/student/:id", (req, res) => {
    let studentId = req.params.id;
    let sql = "SELECT * FROM student WHERE id=" + studentId;
    db.query(sql, function (error, result) {
        if (error) {
            console.log("Error connection to DB");
        } else {
            res.send({ status: true, data: result});
        }
    });
});

// Update records
app.put("/api/student/update/:id", (req, res) => {
    let sql = 
        "UPDATE student SET name='"+
        req.body.name +
        "', course='" +
        req.body.course +
        "', fee='" +
        req.body.fee +
        "' WHERE id=" +
        req.params.id;

        let query =  db.query(sql, (error, result) => {
            if (error) {
                res.send({ status: false, message: "Student updated failed"});
            } else {
                res.send({ status: false, message: "Studend updated successfully"});
            }
        });
});

//Delete the Records
app.delete("/api/student/delete/:id", (req, res) => {
    let sql = "DELETE FROM student WHERE id=" + req.params.id + "";
    let query = db.query(sql, (error) => {
        if (error) {
            res.send({ status: false, message: "Student delete failed" });
        } else {
            res.send({ status: true, message: "Student delete successfully" });
        }
    });
})