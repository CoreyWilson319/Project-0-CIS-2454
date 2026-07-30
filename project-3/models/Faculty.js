// Imports
import {Sequelize, DataTypes} from "sequelize";
import { sequelize } from "../sequelize.js";

// Create Faculty Model with Constraints

const Faculty = sequelize.define("faculty", {
    id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    name: {        
        type: DataTypes.STRING(100),
    },
    email: {
        type: DataTypes.STRING(100),
    }
}, {
        timestamps: false,
    })


export default Faculty;