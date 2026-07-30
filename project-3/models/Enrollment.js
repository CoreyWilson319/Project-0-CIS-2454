import {Sequelize, DataTypes} from "sequelize";
import { sequelize } from "../sequelize.js";


const Enrollment = sequelize.define("enrollment", {
    id: {
        type: DataTypes.INTEGER,
        autoIncrement: true,
        primaryKey: true,
    },
    student_id: {        
        type: DataTypes.STRING(100),
    },
    section_id: {
        type: DataTypes.STRING(100),
    }, 
    grade: {
        type: DataTypes.STRING(2)
    }
}, {
        timestamps: false,
    })




export default Enrollment;