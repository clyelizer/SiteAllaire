const { DataTypes } = require('sequelize');
const sequelize = require('../config/database');

const SchoolClass = sequelize.define('SchoolClass', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  name: {
    type: DataTypes.STRING,
    allowNull: false,
    unique: true,
  },
});

module.exports = SchoolClass;
