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

const app = express();
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
const port = process.env.port || 3000

app.get("/", (req, res) => {
    res.send("Hello World")
})

app.use("/students", students)
app.use("/courses", courses)
app.use("/enrollments", enrollments)
app.use("/sections", sections)
app.use("/faculty", faculty)

app.listen(port, () => {
    dbConnection()
    console.log(`Listening on port ${port}`)
})

