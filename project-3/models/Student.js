// Imports
import {Sequelize, DataTypes} from "sequelize";
import { sequelize } from "../sequelize.js";

// Create Student Model with Constraints
const Student = sequelize.define("students", {
    id: {
        type: DataTypes.INTEGER,
        autoIncrement: true,
        primaryKey: true,
    },
    name: {        
        type: DataTypes.STRING(100),
    },
    major: {
        type: DataTypes.STRING(100),
    }, 
}, {
        timestamps: false,
    })


export default Student;