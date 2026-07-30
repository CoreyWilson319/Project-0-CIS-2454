import express from "express";
import Enrollment from "../models/Enrollment.js";
import sequelize from "sequelize";

const router = express.Router();


router.get("/", async (req, res) => {
    res.status(200).send("Hello at /enrollments");
})

router.get("/all", async (req, res) => {
    try {

        const allEnrollments = await Enrollment.findAll();
        res.status(200).send({"Enrollments": allEnrollments});
    } 
    catch (err) {
        res.status(400).send({"msg": err})
    }
})

router.get("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingEnrollment = await Enrollment.findByPk(id);
        if (existingEnrollment) {
            res.status(300).json({existingEnrollment})
        } else {
            res.status(404).send({"msg": "Enrollment not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

router.post("/add", async (req, res) => {
    const student_id = req.body.student_id;
    const section_id = req.body.section_id;
    let grade = null;
    if (req.body.grade) {
        grade = req.body.grade
    }
    
    try {
        const [existingEnrollment, newEnrollment] = await Enrollment.findOrCreate({
            where: {student_id, section_id, grade}
        })

        if (newEnrollment) {
            res.status(200).send({"msg": "Successfuly created new Enrollment"});
        } else if (existingEnrollment) {
            res.status(400).send({"msg": "Enrollment Already Exists!"})
        }

    } catch (err) {
        console.error(err)
        res.status(400).json({
            message: err.message,
            sql: err.sql,
            parent: err.parent
        });
    }
})

router.put("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingEnrollment = await Enrollment.findByPk(id);
        if (existingEnrollment) {
            let grade = null
            const student_id = req.body.student_id;
            const section_id = req.body.section_id;
            if (req.body.grade) {
                grade = req.body.grade
            }
            existingEnrollment.student_id = student_id;
            existingEnrollment.section_id = section_id;
            existingEnrollment.grade = grade;
            await existingEnrollment.save()
            res.status(300).json({"msg": existingEnrollment})
        } else {
            res.status(404).send({"msg": "Enrollment not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})


router.delete("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingEnrollment = await Enrollment.findByPk(id);
        if (existingEnrollment) {
            await existingEnrollment.destroy();
            res.status(300).send({"msg": "Enrollment successfully deleted!"})
        } else {
            res.status(404).send({"msg": "Enrollment not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

export default router;