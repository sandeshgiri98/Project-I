
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('src',
            '../pop_up/eyeclose.svg');
    } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('src',
            '../pop_up/eyeopen.svg');
    }
}

