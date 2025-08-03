const container = document.querySelector('.container');
const registerLinks = document.querySelectorAll('.switch .register-btn');
const loginLinks = document.querySelectorAll('.switch .login-btn');

registerLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        container.classList.add('active');
    });
});

loginLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        container.classList.remove('active');
    });
});