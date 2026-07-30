// Imports
import express from "express";
import Student from "../models/Student.js";
import sequelize from "sequelize";

const router = express.Router();
// Follows same logic as courses route only major changes are
// The Model name and parameters and variables being used

router.get("/", async (req, res) => {
    res.status(200).send("Hello at /student");
})

router.get("/all", async (req, res) => {
    try {

        const allStudents = await Student.findAll();
        res.status(200).send({"students": allStudents});
    } 
    catch (err) {
        res.status(400).send({"msg": err})
    }
})

router.post("/add", async (req, res) => {
    const name = req.body.name;
    const major = req.body.major;
    try {
        const [existingStudent, newStudent] = await Student.findOrCreate({
            where: {name, major}
        })

        if (newStudent) {
            res.status(200).send({"msg": "Successfuly created new student"});
        } else if (existingStudent) {
            res.status(400).send({"msg": "Student Already Exists!"})
        }

    } catch (err) {
        console.error(err)
        res.status(400).json({
            message: err.message,
            sql: error.sql,
            parent: error.parent
        });
    }
})

router.put("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingStudent = await Student.findByPk(id);
        if (existingStudent) {

            const name = req.body.name;
            const major = req.body.major;
            existingStudent.name = name;
            existingStudent.major = major;
            await existingStudent.save()
            res.status(300).json({"msg": existingStudent})
        } else {
            res.status(404).send({"msg": "Student not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

router.get("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingStudent = await Student.findByPk(id);
        if (existingStudent) {
            res.status(300).json({existingStudent})
        } else {
            res.status(404).send({"msg": "Student not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})


router.delete("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingStudent = await Student.findByPk(id);
        if (existingStudent) {
            await existingStudent.destroy();
            res.status(300).send({"msg": "Student successfully deleted!"})
        } else {
            res.status(404).send({"msg": "Student not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

export default router;