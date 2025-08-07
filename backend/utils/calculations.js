const get_subject_appreciation = (moy_cl, n_compo) => {
  if (moy_cl === null || n_compo === null) {
    return 'N/A';
  }
  const mg = (parseFloat(moy_cl) + 2 * parseFloat(n_compo)) / 3.0;
  if (mg >= 16) return 'Très Bien';
  if (mg >= 14) return 'Bien';
  if (mg >= 12) return 'Assez Bien';
  if (mg >= 10) return 'Passable';
  if (mg >= 8) return 'Insuffisant';
  return 'Faible';
};

const calculateAverage = (moy_cl, n_compo) => {
  return (parseFloat(moy_cl) + 2 * parseFloat(n_compo)) / 3;
};

const getAppreciation = (average) => {
  if (average >= 16) return "Excellent";
  if (average >= 14) return "Très bien";
  if (average >= 12) return "Bien";
  if (average >= 10) return "Assez bien";
  return "Insuffisant";
};

module.exports = {
  get_subject_appreciation,
  calculateAverage,
  getAppreciation,
};
