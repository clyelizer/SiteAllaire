const express = require('express');
const { sequelize } = require('./models');
const authRoutes = require('./routes/auth');
const classRoutes = require('./routes/classes');
const gradeRoutes = require('./routes/grades');
const userRoutes = require('./routes/users');
const bulletinRoutes = require('./routes/bulletins');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());

// Routes
app.use('/api/auth', authRoutes);
app.use('/api/classes', classRoutes);
app.use('/api/grades', gradeRoutes);
app.use('/api/users', userRoutes);
app.use('/api/bulletins', bulletinRoutes);

// Sync database and start server
sequelize.sync({ force: true }) // Use { force: true } only for development, it will drop tables
  .then(() => {
    console.log('Database synchronized');
    app.listen(PORT, () => {
      console.log(`Server is running on port ${PORT}`);
    });
  })
  .catch((error) => {
    console.error('Unable to synchronize the database:', error);
  });
