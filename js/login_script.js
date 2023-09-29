document.addEventListener("DOMContentLoaded", function() {
    var loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function(event) {
        var username = loginForm.querySelector('input[name="username"]').value;
        var password = loginForm.querySelector('input[name="password"]').value;
        var isValid = true;
        if (username.trim() === "") {
            alert("Username is required.");
            isValid = false;
        }

        if (password.trim() === "") {
            alert("Password is required.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
