const wrapper = document.getElementById('wrapper');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signUp');

function showRegister(isRegister) {
    wrapper.classList.toggle('active', isRegister);
    // "inert" stops the hidden form from being clicked or tabbed into
    signUpForm.inert = !isRegister;
    signInForm.inert = isRegister;
}

document.getElementById('signUpButton').addEventListener('click', () => showRegister(true));
document.getElementById('signInButton').addEventListener('click', () => showRegister(false));

// After a successful sign up, slide from Register to Log In
if (new URLSearchParams(window.location.search).get('registered') === '1') {
    wrapper.classList.add('no-anim');   // turn animation off
    showRegister(true);                 // start on the Register side instantly
    wrapper.offsetHeight;               // force the browser to apply it
    wrapper.classList.remove('no-anim'); // turn animation back on

    setTimeout(() => showRegister(false), 900); // slide to Log In

    // remove ?registered=1 so refreshing doesn't replay it
    history.replaceState(null, '', window.location.pathname);
}