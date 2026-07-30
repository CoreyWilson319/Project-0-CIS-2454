import { sequelize } from "./sequelize.js";
import Course from "./models/Course.js";
import Enrollment from "./models/Enrollment.js";
import Faculty from "./models/Faculty.js";
import Section from "./models/Section.js";
import Student from "./models/Student.js";



const dbConnection = async () => { 
    try {
            await sequelize.authenticate();
            await sequelize.sync();
            console.log("Successfully Conencted to DB");
        } catch (err) {
            console.error("Error connecting to database", err);
        
}
}

Course.hasMany(Section, {foreignKey: "course_code", sourceKey: "code"})

Section.belongsTo(Course, { foreignKey: "course_code", targetKey: "code"})
Section.belongsTo(Faculty, { foreignKey: "faculty_id"})

Enrollment.belongsTo(Student, { foreignKey: "student_id" })
Enrollment.belongsTo(Section, { foreignKey: "section_id" })

Student.hasMany(Enrollment, {foreignKey: "student_id"})
Section.hasMany(Enrollment, {foreignKey: "section_id"})

export default dbConnection;
