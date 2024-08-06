<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Mismatch Alert</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<form id="updateForm" method="POST" action="update.php">
    <!-- Your form inputs for name, surname, email, etc. -->
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="surname" placeholder="Surname">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="phone" placeholder="Phone">
    <input type="number" name="age" placeholder="Age">
    <input type="hidden" name="customer_id" value="12345">
    
    <!-- Password and confirm password fields -->
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="confirm_password" placeholder="Confirm Password">
    
    <button type="submit">Update</button>
</form>

<script>
document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var formData = new FormData(this);

    fetch('update.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'password_mismatch') {
            Swal.fire({
                title: 'Password Mismatch',
                text: 'The passwords do not match. Please try again.',
                icon: 'error'
            });
        } else if (data.status === 'ok') {
            Swal.fire({
                title: 'Success',
                text: 'Profile updated successfully.',
                icon: 'success'
            }).then(() => {
                window.location.href = '../profile.php';
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while updating the profile.',
                icon: 'error'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            title: 'Error',
            text: 'A network error occurred. Please try again.',
            icon: 'error'
        });
    });
});
</script>

</body>
</html>
