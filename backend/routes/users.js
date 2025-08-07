const express = require('express');
const { User } = require('../models');
const authMiddleware = require('../middleware/auth');
const router = express.Router();

// Get all users
router.get('/', authMiddleware, async (req, res) => {
  try {
    const users = await User.findAll({ attributes: { exclude: ['password'] } });
    res.json(users);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while fetching users' });
  }
});

// Get a single user by ID
router.get('/:userId', authMiddleware, async (req, res) => {
  try {
    const user = await User.findByPk(req.params.userId, { attributes: { exclude: ['password'] } });
    if (!user) {
      return res.status(404).json({ error: 'User not found' });
    }
    res.json(user);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while fetching the user' });
  }
});

// Update a user
router.put('/:userId', authMiddleware, async (req, res) => {
  try {
    const user = await User.findByPk(req.params.userId);
    if (!user) {
      return res.status(404).json({ error: 'User not found' });
    }

    const { username, role, class_id } = req.body;
    user.username = username;
    user.role = role;
    user.current_class_id = class_id;

    await user.save();
    res.json(user);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while updating the user' });
  }
});

// Delete a user
router.delete('/:userId', authMiddleware, async (req, res) => {
  try {
    const user = await User.findByPk(req.params.userId);
    if (!user) {
      return res.status(404).json({ error: 'User not found' });
    }
    await user.destroy();
    res.json({ message: 'User deleted successfully' });
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while deleting the user' });
  }
});

module.exports = router;
