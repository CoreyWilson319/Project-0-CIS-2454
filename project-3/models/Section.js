import {Sequelize, DataTypes} from "sequelize";
import { sequelize } from "../sequelize.js";

const Section = sequelize.define("section", {
    id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    course_code: {        
        type: DataTypes.STRING(10),
    },
    faculty_id: {
        type: DataTypes.INTEGER,
    }, 
    semester: {
        type: DataTypes.STRING(10),
    }
}, {
        timestamps: false,
    })





export default Section;