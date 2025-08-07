const { DataTypes } = require('sequelize');
const sequelize = require('../config/database');

const BulletinStructure = sequelize.define('BulletinStructure', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  school_class_id: {
    type: DataTypes.INTEGER,
    references: {
      model: 'SchoolClasses', // This should match the table name of SchoolClass model
      key: 'id',
    },
    allowNull: false,
    unique: true,
  },
  subjects_part1: {
    type: DataTypes.TEXT,
    allowNull: false,
  },
  subjects_part2: {
    type: DataTypes.TEXT,
    allowNull: false,
  },
});

module.exports = BulletinStructure;
