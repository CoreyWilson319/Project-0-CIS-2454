import {Sequelize, DataTypes} from "sequelize";
import { sequelize } from "../sequelize.js";

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