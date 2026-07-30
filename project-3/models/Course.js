// Imports
import {Sequelize, DataTypes} from "sequelize";
import { sequelize } from "../sequelize.js";

// Create Course Model with Constraints
const Course = sequelize.define("course", {
    code: {
        type: DataTypes.STRING(10),
        primaryKey: true,
    },
    name: {        
        type: DataTypes.STRING(100),
    },
    description: {
        type: DataTypes.TEXT,
    }, 
    credits: {
        type: DataTypes.INTEGER(11),
    }
}, {
        timestamps: false,
    })


export default Course;