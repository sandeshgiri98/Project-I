function validateForm() {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const contact = document.getElementById('contact').value.trim();
  const dob = document.getElementById('dob').value.trim();
  const password = document.getElementById('password').value;
  const repassword = document.getElementById('repassword').value;
  let valid = true;

  if (!/^[a-zA-Z\s]+$/.test(name)) {
    valid = false;
    document.getElementById('name-error').classList.add('active');
  } else {
    document.getElementById('name-error').classList.remove('active');
  }

  // email
  if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
    valid = false;
    document.getElementById('email-error').classList.add('active');
  } else {
    document.getElementById('email-error').classList.remove('active');
  }

  // contact
  if (!contact.startsWith('9') || !/^\d{9}$/.test(contact.slice(1))) {
    valid = false;
    document.getElementById('contact-error').classList.add('active');
  } else {
    document.getElementById('contact-error').classList.remove('active');
  }

  // dob
  const currentDate = new Date();
  const dobValue = new Date(dob);
  const diffInYears = (currentDate - dobValue) / (1000 * 60 * 60 * 24 * 365.25);

  if (isNaN(diffInYears) || diffInYears < 14) {
    valid = false;
    document.getElementById('dob-error').classList.add('active');
  } else {
    document.getElementById('dob-error').classList.remove('active');
  }

  // password is at least 8 characters long and includes a number and a special character
  if (!/^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,}$/.test(password)) {
    valid = false;
    document.getElementById('password-error').classList.add('active');
  } else {
    document.getElementById('password-error').classList.remove('active');
  }

  // Check if passwords match
  if (repassword !== password) {
    valid = false;
    document.getElementById('repassword-error').classList.add('active');
  } else {
    document.getElementById('repassword-error').classList.remove('active');
  }

  return valid;
}
