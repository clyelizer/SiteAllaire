// JS de base pour le menu ou les interactions futures
// Ajoutez ici vos scripts personnalisés

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            fetch('contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('form-message').textContent = data;
                form.reset();
            })
            .catch(() => {
                document.getElementById('form-message').textContent = 'Erreur lors de l\'envoi du message.';
            });
        });
    }
    
    const galerie = document.querySelector('.galerie-images');
    const leftBtn = document.getElementById('galerie-left');
    const rightBtn = document.getElementById('galerie-right');
    let autoScroll;
    function startAutoScroll() {
        autoScroll = setInterval(function() {
            if (galerie) {
                galerie.scrollBy({ left: 2, behavior: 'auto' });
            }
        }, 20);
    }
    function stopAutoScroll() {
        clearInterval(autoScroll);
    }
    if (galerie) {
        galerie.addEventListener('mouseenter', stopAutoScroll);
        galerie.addEventListener('mouseleave', startAutoScroll);
        startAutoScroll();
    }
    if (leftBtn && rightBtn) {
        leftBtn.addEventListener('click', function() {
            galerie.scrollBy({ left: -300, behavior: 'smooth' });
        });
        rightBtn.addEventListener('click', function() {
            galerie.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }
    const plusBtn = document.getElementById('galerie-plus');
    if (plusBtn) {
        plusBtn.addEventListener('click', function() {
            alert('Ajoutez plus d\'images dans le dossier Images pour les afficher ici.');
        });
    }
});
