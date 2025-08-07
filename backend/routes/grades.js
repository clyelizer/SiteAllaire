const express = require('express');
const { Grade } = require('../models');
const { get_subject_appreciation } = require('../utils/calculations');
const authMiddleware = require('../middleware/auth');
const router = express.Router();

// Get all grades for a student
router.get('/student/:studentId', authMiddleware, async (req, res) => {
  try {
    const grades = await Grade.findAll({
      where: { student_id: req.params.studentId },
      order: [['date', 'DESC']],
    });
    res.json(grades);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while fetching grades' });
  }
});

// Add a new grade
router.post('/', authMiddleware, async (req, res) => {
  try {
    const { student_id, subject, moy_cl, n_compo, coef, period } = req.body;
    if (!student_id || !subject || !moy_cl || !n_compo || !coef || !period) {
      return res.status(400).json({ error: 'All fields are required' });
    }

    const appreciation = get_subject_appreciation(moy_cl, n_compo);

    const newGrade = await Grade.create({
      student_id,
      subject,
      moy_cl,
      n_compo,
      coef,
      appreciation,
      period,
    });
    res.status(201).json(newGrade);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while adding the grade' });
  }
});

// Update a grade
router.put('/:gradeId', authMiddleware, async (req, res) => {
  try {
    const grade = await Grade.findByPk(req.params.gradeId);
    if (!grade) {
      return res.status(404).json({ error: 'Grade not found' });
    }

    const { moy_cl, n_compo, coef, period } = req.body;
    grade.moy_cl = moy_cl;
    grade.n_compo = n_compo;
    grade.coef = coef;
    grade.period = period;
    grade.appreciation = get_subject_appreciation(moy_cl, n_compo);

    await grade.save();
    res.json(grade);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while updating the grade' });
  }
});

// Delete a grade
router.delete('/:gradeId', authMiddleware, async (req, res) => {
  try {
    const grade = await Grade.findByPk(req.params.gradeId);
    if (!grade) {
      return res.status(404).json({ error: 'Grade not found' });
    }
    await grade.destroy();
    res.json({ message: 'Grade deleted successfully' });
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while deleting the grade' });
  }
});

module.exports = router;
