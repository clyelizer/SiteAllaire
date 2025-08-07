const { DataTypes } = require('sequelize');
const sequelize = require('../config/database');

const Grade = sequelize.define('Grade', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  student_id: {
    type: DataTypes.INTEGER,
    references: {
      model: 'Users', // This should match the table name of User model
      key: 'id',
    },
    allowNull: false,
  },
  subject: {
    type: DataTypes.STRING,
    allowNull: false,
  },
  moy_cl: {
    type: DataTypes.FLOAT,
    allowNull: false,
  },
  n_compo: {
    type: DataTypes.FLOAT,
    allowNull: false,
  },
  coef: {
    type: DataTypes.INTEGER,
    allowNull: false,
  },
  appreciation: {
    type: DataTypes.STRING,
    allowNull: true,
  },
  date: {
    type: DataTypes.DATE,
    allowNull: false,
    defaultValue: DataTypes.NOW,
  },
  period: {
    type: DataTypes.STRING,
    allowNull: false,
  },
});

module.exports = Grade;
