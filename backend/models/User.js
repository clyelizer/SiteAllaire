const { DataTypes } = require('sequelize');
const sequelize = require('../config/database'); // Assuming you have a database config file

const User = sequelize.define('User', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  username: {
    type: DataTypes.STRING,
    allowNull: false,
    unique: true,
  },
  password: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  role: {
    type: DataTypes.STRING,
    allowNull: false, // 'teacher' or 'student'
  },
  current_class_id: {
    type: DataTypes.INTEGER,
    references: {
      model: 'SchoolClasses', // This should match the table name of SchoolClass model
      key: 'id',
    },
    allowNull: true,
  },
});

module.exports = User;
