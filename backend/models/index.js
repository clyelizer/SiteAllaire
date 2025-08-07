const sequelize = require('../config/database');
const User = require('./User');
const SchoolClass = require('./SchoolClass');
const Grade = require('./Grade');
const BulletinStructure = require('./BulletinStructure');

// Define associations
User.hasMany(Grade, { foreignKey: 'student_id' });
Grade.belongsTo(User, { foreignKey: 'student_id' });

SchoolClass.hasMany(User, { foreignKey: 'current_class_id' });
User.belongsTo(SchoolClass, { foreignKey: 'current_class_id' });

SchoolClass.hasOne(BulletinStructure, { foreignKey: 'school_class_id' });
BulletinStructure.belongsTo(SchoolClass, { foreignKey: 'school_class_id' });

const models = {
  sequelize,
  User,
  SchoolClass,
  Grade,
  BulletinStructure,
};

module.exports = models;
