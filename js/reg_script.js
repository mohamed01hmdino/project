document.getElementById('registerForm').addEventListener('submit', function(event) {
    var password = document.getElementsByName('password')[0].value;
    var confirmPassword = document.getElementsByName('confirmPassword')[0].value;
    var username = document.getElementsByName("username")[0].value;
    
    if (username.trim() === "") {
        alert("Username is required.");
        event.preventDefault();   
    }
    if (password !== confirmPassword) {
      alert('Passwords do not match.');
      event.preventDefault();
    }
  });