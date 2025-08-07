const { Sequelize } = require('sequelize');

const sequelize = new Sequelize({
  dialect: 'sqlite',
  storage: './school.db', // This will create a school.db file in the root of the backend project
});

module.exports = sequelize;
