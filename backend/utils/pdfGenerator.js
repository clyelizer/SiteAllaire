const PDFDocument = require('pdfkit');

const generateBulletinPdf = (res, studentData, grades) => {
  const doc = new PDFDocument({ size: 'A4', margin: 50 });

  doc.pipe(res);

  // Header
  doc.fontSize(20).text(studentData.school_name, { align: 'center' });
  doc.fontSize(12).text(`Année Scolaire: ${studentData.academic_year}`, { align: 'center' });
  doc.moveDown();

  // Student Info
  doc.fontSize(14).text(`Bulletin de notes de: ${studentData.student_name}`);
  doc.text(`Classe: ${studentData.class_name}`);
  doc.moveDown();

  // Grades Table
  const tableTop = 200;
  const itemX = 50;
  const descriptionX = 150;
  const moyClX = 300;
  const nCompoX = 370;
  const coefX = 440;
  const appreciationX = 510;

  doc.fontSize(10);
  doc.text('Matière', itemX, tableTop);
  doc.text('Moy. CL', moyClX, tableTop);
  doc.text('N. Compo', nCompoX, tableTop);
  doc.text('Coef', coefX, tableTop);
  doc.text('Appreciation', appreciationX, tableTop);

  let y = tableTop + 25;
  grades.forEach(grade => {
    doc.text(grade.subject, itemX, y);
    doc.text(grade.moy_cl.toString(), moyClX, y);
    doc.text(grade.n_compo.toString(), nCompoX, y);
    doc.text(grade.coef.toString(), coefX, y);
    doc.text(grade.appreciation, appreciationX, y);
    y += 25;
  });

  doc.end();
};

module.exports = { generateBulletinPdf };
