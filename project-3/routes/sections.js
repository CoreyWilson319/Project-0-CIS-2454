// Imports
import express from "express";
import Section from "../models/Section.js";
import sequelize from "sequelize";

const router = express.Router();
// Follows same logic as courses route only major changes are
// The Model name and parameters and variables being used

router.get("/", async (req, res) => {
    res.status(200).send("Hello at /section");
})

router.get("/all", async (req, res) => {
    try {

        const allSections = await Section.findAll();
        res.status(200).json({allSections});
    } 
    catch (err) {
        res.status(400).send({"msg": err})
    }
})

router.post("/add", async (req, res) => {
    const course_code = req.body.course_code;
    const faculty_id = req.body.faculty_id;
    const semester = req.body.semester;
    try {
        const [existingSection, newSection] = await Section.findOrCreate({
            where: {course_code, faculty_id, semester}
        })

        if (newSection) {
            res.status(200).send({"msg": "Successfuly created new Section"});
        } else if (existingSection) {
            res.status(400).send({"msg": "Section Already Exists!"})
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
        const existingSection = await Section.findByPk(id);
        if (existingSection) {

            const course_code = req.body.course_code;
            const faculty_id = req.body.faculty_id;
            const semester = req.body.semester;
            existingSection.course_code = course_code;
            existingSection.faculty_id = faculty_id;
            existingSection.semester = semester;
            await existingSection.save()
            res.status(300).json({"msg": existingSection})
        } else {
            res.status(404).send({"msg": "Section not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

router.get("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingSection = await Section.findByPk(id);
        if (existingSection) {
            res.status(300).json({existingSection})
        } else {
            res.status(404).send({"msg": "Section not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})


router.delete("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingSection = await Section.findByPk(id);
        if (existingSection) {
            await existingSection.destroy();
            res.status(300).send({"msg": "Section successfully deleted!"})
        } else {
            res.status(404).send({"msg": "Section not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

export default router;