function comparePasswords() {
    let password1 = document.getElementById('password').value;
    let password2 = document.getElementById('confirm').value;
    let pwMsg = document.getElementById('pwMsg');
    if (password1 != password2) {
        pwMsg.innerText = 'Passwords do not match';
        pwMsg.className = 'text-danger';
        return false;
    }
    else {
        pwMsg.innerText = '';
        pwMsg.className = '';
        return true;
    }
}