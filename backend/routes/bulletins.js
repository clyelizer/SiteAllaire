const express = require('express');
const { BulletinStructure, SchoolClass } = require('../models');
const authMiddleware = require('../middleware/auth');
const router = express.Router();

// Get all bulletin structures
router.get('/', authMiddleware, async (req, res) => {
  try {
    const structures = await BulletinStructure.findAll({ include: SchoolClass });
    res.json(structures);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while fetching bulletin structures' });
  }
});

// Create a new bulletin structure
router.post('/', authMiddleware, async (req, res) => {
  try {
    const { school_class_id, subjects_part1, subjects_part2 } = req.body;
    if (!school_class_id || !subjects_part1 || !subjects_part2) {
      return res.status(400).json({ error: 'All fields are required' });
    }
    const newStructure = await BulletinStructure.create({
      school_class_id,
      subjects_part1,
      subjects_part2,
    });
    res.status(201).json(newStructure);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while creating the bulletin structure' });
  }
});

// Update a bulletin structure
router.put('/:structureId', authMiddleware, async (req, res) => {
  try {
    const structure = await BulletinStructure.findByPk(req.params.structureId);
    if (!structure) {
      return res.status(404).json({ error: 'Bulletin structure not found' });
    }

    const { school_class_id, subjects_part1, subjects_part2 } = req.body;
    structure.school_class_id = school_class_id;
    structure.subjects_part1 = subjects_part1;
    structure.subjects_part2 = subjects_part2;

    await structure.save();
    res.json(structure);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while updating the bulletin structure' });
  }
});

// Delete a bulletin structure
router.delete('/:structureId', authMiddleware, async (req, res) => {
  try {
    const structure = await BulletinStructure.findByPk(req.params.structureId);
    if (!structure) {
      return res.status(404).json({ error: 'Bulletin structure not found' });
    }
    await structure.destroy();
    res.json({ message: 'Bulletin structure deleted successfully' });
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while deleting the bulletin structure' });
  }
});

const { generateBulletinPdf } = require('../utils/pdfGenerator');
const { User, Grade, SchoolClass } = require('../models');

// Generate a bulletin PDF
router.get('/generate/:studentId', authMiddleware, async (req, res) => {
  try {
    const student = await User.findByPk(req.params.studentId, { include: SchoolClass });
    if (!student || student.role !== 'student') {
      return res.status(404).json({ error: 'Student not found' });
    }

    const grades = await Grade.findAll({ where: { student_id: req.params.studentId } });

    const studentData = {
      school_name: 'Lycée Michel ALLAIRE',
      academic_year: '2024-2025',
      student_name: student.username,
      class_name: student.SchoolClass ? student.SchoolClass.name : 'N/A',
    };

    res.setHeader('Content-Type', 'application/pdf');
    res.setHeader('Content-Disposition', `attachment; filename=bulletin_${student.username}.pdf`);

    generateBulletinPdf(res, studentData, grades);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while generating the PDF' });
  }
});

module.exports = router;
