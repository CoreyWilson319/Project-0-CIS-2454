// Imports
import express from "express";
import Course from "../models/Course.js";
import sequelize from "sequelize";

// Create an expess router
const router = express.Router();

// Get Test that Courses Route works
router.get("/", async (req, res) => {
    res.status(200).send("Hello at /courses");
})

// Return all courses
router.get("/all", async (req, res) => {
    try {

        // Query to select all Courses
        const allCourses = await Course.findAll();
        res.status(200).send({"Courses": allCourses});
    } 
    catch (err) {
        res.status(400).send({"msg": err})
    }
})

// Create new Course
router.post("/add", async (req, res) => {
    // Get variable from request body
    const code = req.body.code;
    const name = req.body.name;
    const description = req.body.description;
    const credits = req.body.credits;
    try {
        // Find a Course where the code, name description and credits are the same if no match create a new Course
        const [existingCourse, newCourse] = await Course.findOrCreate({
            where: {code, name, description, credits}
        })

        // If new Course Created inform user
        if (newCourse) {
            res.status(200).send({"msg": "Successfuly created new course"});
        // If no new Course created inform user
        } else if (existingCourse) {
            res.status(400).send({"msg": "Course Already Exists!"})
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

// Update Course via code field
router.put("/:code", async (req, res) => {
    try {
        // Get code from request paramaters
        const code = req.params.code;
        // Search Course via primary_key code
        const existingCourse = await Course.findByPk(code);
        if (existingCourse) {
            // If Course found get name, description and credits from request body
            const name = req.body.name;
            const description = req.body.description;
            const credits = req.body.credits;

            // Set the Course found attributes to be the request body variables
            existingCourse.name = name;
            existingCourse.description = description;
            existingCourse.credits = credits;
            // Save Course to maintain update
            await existingCourse.save()
            res.status(300).json({existingCourse})
        } else {
            res.status(404).send({"msg": "Course not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

// Get Course by code
router.get("/:code", async (req, res) => {
    try {
        // Get code from request paramaters
        const code = req.params.code;
        // Search for course by the parameter 
        const existingCourse = await Course.findByPk(code);
        if (existingCourse) {
            // if course found return course to user
            res.status(300).json({existingCourse})
        } else {
            // otherwise inform user no course found
            res.status(404).send({"msg": "Course not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})


router.delete("/:code", async (req, res) => {
    try {
        const code = req.params.code;
        // Find Course by course code
        const existingCourse = await Course.findByPk(code);
        if (existingCourse) {
            // If course foudn destroy it from the table
            await existingCourse.destroy();
            // Inform user that course was deleted
            res.status(300).send({"msg": "Course successfully deleted!"})
        } else {
            // Inform user that course was not found
            res.status(404).send({"msg": "Course not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

export default router;