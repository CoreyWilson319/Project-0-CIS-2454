// Imports
import dotenv from 'dotenv';
import express  from "express";
import mongoose from "mongoose";
import cors from "cors";
import dbConnection from "./db.js"
import students from "./routes/students.js"
import courses from "./routes/courses.js"
import enrollments from "./routes/enrollments.js"
import sections from "./routes/sections.js"
import faculty from "./routes/faculty.js"

dotenv.config()

// Instantiate Express with options for Cors, JSON, and URLEncoding
const app = express();
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Instantiate port using .env or default to 3000
const port = process.env.port || 3000

// Barebones route to test api with hello world
app.get("/", (req, res) => {
    res.send("Hello World")
})

// Routes for students, courses, enrollments and faculty routes
app.use("/students", students)
app.use("/courses", courses)
app.use("/enrollments", enrollments)
app.use("/sections", sections)
app.use("/faculty", faculty)

// Start Server using port and connect to database
app.listen(port, () => {
    dbConnection()
    console.log(`Listening on port ${port}`)
})

