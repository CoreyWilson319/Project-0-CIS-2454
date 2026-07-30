import express from "express";
import Faculty from "../models/Faculty.js";
import sequelize from "sequelize";

const router = express.Router();


router.get("/", async (req, res) => {
    res.status(200).send("Hello at /faculty");
})

router.get("/all", async (req, res) => {
    try {

        const allFaculty = await Faculty.findAll();
        res.status(200).json({allFaculty});
    } 
    catch (err) {
        res.status(400).send({"msg": err})
    }
})

router.post("/add", async (req, res) => {
    const name = req.body.name;
    const email = req.body.email;
    try {
        const [existingFaculty, newFaculty] = await Faculty.findOrCreate({
            where: {name, email}
        })

        if (newFaculty) {
            res.status(200).send({"msg": "Successfuly created new faculty member"});
        } else if (existingFaculty) {
            res.status(400).send({"msg": "Faculty Member Already Exists!"})
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
        const existingFaculty = await Faculty.findByPk(id);
        if (existingFaculty) {

            const name = req.body.name;
            const email = req.body.email;
            existingFaculty.name = name;
            existingFaculty.email = email;
            await existingFaculty.save()
            res.status(302).json({"msg": existingFaculty})
        } else {
            res.status(404).send({"msg": "Faculty Member not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

router.get("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingFaculty = await Faculty.findByPk(id);
        if (existingFaculty) {
            res.status(300).json({existingFaculty})
        } else {
            res.status(404).send({"msg": "Faculty member not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})


router.delete("/:id", async (req, res) => {
    try {
        const id = req.params.id;
        const existingFaculty = await Faculty.findByPk(id);
        if (existingFaculty) {
            await existingFaculty.destroy();
            res.status(300).send({"msg": "Faculty Member successfully deleted!"})
        } else {
            res.status(404).send({"msg": "Faculty Member not found!"})
        }
    } catch (err) {
        res.status(400).send(err)
    }
})

export default router;