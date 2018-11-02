const registerLink = document.querySelector('#register-link');
registerLink.addEventListener('click', function(el) {
    const registerForm = document.querySelector('#signup-form');
    registerForm.classList.remove('signup-form-hidden');
    registerForm.classList.add('signup-form-active');
    console.log('test');
});