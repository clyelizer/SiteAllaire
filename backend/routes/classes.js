const express = require('express');
const { SchoolClass } = require('../models');
const authMiddleware = require('../middleware/auth');
const router = express.Router();

// Get all school classes
router.get('/', authMiddleware, async (req, res) => {
  try {
    const classes = await SchoolClass.findAll({ order: [['name', 'ASC']] });
    res.json(classes);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while fetching classes' });
  }
});

// Create a new school class
router.post('/', authMiddleware, async (req, res) => {
  try {
    const { name } = req.body;
    if (!name) {
      return res.status(400).json({ error: 'Class name is required' });
    }
    const newClass = await SchoolClass.create({ name });
    res.status(201).json(newClass);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while creating the class' });
  }
});

module.exports = router;
