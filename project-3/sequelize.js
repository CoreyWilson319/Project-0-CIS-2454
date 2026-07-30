import dotenv from "dotenv";
import { Sequelize } from 'sequelize';

dotenv.config();

// Sequelize constructor to establish connection
const sequelize = new Sequelize(
    process.env.database,
    process.env.user,
    process.env.password,
    
    {
        host: process.env.url,
        dialect: "mysql",
        define: {
        freezeTableName: true
    }
    },

);

export {sequelize};