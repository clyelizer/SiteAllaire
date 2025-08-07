const express = require('express');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const { User } = require('../models');
const { validate, registerSchema, loginSchema } = require('../middleware/validation');
const router = express.Router();

const JWT_SECRET = process.env.JWT_SECRET || 'your-super-secret-key'; // Change this in production

// Register a new user
router.post('/register', validate(registerSchema), async (req, res) => {
  try {
    const { username, password, role, class_id } = req.body;

    const hashedPassword = await bcrypt.hash(password, 10);
    const user = await User.create({
      username,
      password: hashedPassword,
      role,
      current_class_id: class_id,
    });

    res.status(201).json({
      message: 'User registered successfully',
      user: { id: user.id, username: user.username, role: user.role },
    });
  } catch (error) {
    res.status(500).json({ error: 'An error occurred during registration' });
  }
});

// Login a user
router.post('/login', validate(loginSchema), async (req, res) => {
  try {
    const { username, password } = req.body;
    const user = await User.findOne({ where: { username } });

    if (!user) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    const isPasswordValid = await bcrypt.compare(password, user.password);
    if (!isPasswordValid) {
      return res.status(401).json({ error: 'Invalid credentials' });
    }

    const token = jwt.sign({ id: user.id, role: user.role }, JWT_SECRET, {
      expiresIn: '1h',
    });

    res.json({
      message: 'Login successful',
      token,
      user: { id: user.id, username: user.username, role: user.role },
    });
  } catch (error) {
    res.status(500).json({ error: 'An error occurred during login' });
  }
});

module.exports = router;
