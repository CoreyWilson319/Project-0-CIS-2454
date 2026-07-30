import express from "express";
import Course from "../models/Course.js";
import sequelize from "sequelize";

const router = express.Router();


router.get("/", async (req, res) => {
    res.status(200).send("Hello at /courses");
})

router.get("/all", async (req, res) => {
    try {

        const allCourses = await Course.findAll();
        res.status(200).send({"Courses": allCourses});
    } 
    catch (err) {
        res.status(400).send({"msg": err})
    }
})

router.post("/add", async (req, res) => {
    const code = req.body.code;
    const name = req.body.name;
    const description = req.body.description;
    const credits = req.body.credits;
    try {
        const [existingCourse, newCourse] = await Course.findOrCreate({
            where: {code, name, description, credits}
        })

        if (newCourse) {
            res.status(200).send({"msg": "Successfuly created new course"});
        } else if (existingCourse) {
            res.status(400).send({"msg": "Course Already Exists!"})
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

router.put("/:code", async (req, res) => {
    try {
        const code = req.params.code;
        const existingCourse = await Course.findByPk(code);
        if (existingCourse) {

            const name = req.body.name;
            const description = req.body.description;
            const credits = req.body.credits;

            existingCourse.name = name;
            existingCourse.description = description;
            existingCourse.credits = credits;
            await existingCourse.save()
            res.status(300).json({existingCourse})
        } else {
            res.status(404).send({"msg": "Course not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

router.get("/:code", async (req, res) => {
    try {
        const code = req.params.code;
        const existingCourse = await Course.findByPk(code);
        if (existingCourse) {
            res.status(300).json({existingCourse})
        } else {
            res.status(404).send({"msg": "Course not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})


router.delete("/:code", async (req, res) => {
    try {
        const code = req.params.code;
        const existingCourse = await Course.findByPk(code);
        if (existingCourse) {
            await existingCourse.destroy();
            res.status(300).send({"msg": "Course successfully deleted!"})
        } else {
            res.status(404).send({"msg": "Course not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

export default router;