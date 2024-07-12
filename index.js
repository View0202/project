document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('login');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        saveuser();
    });
});

function saveuser() {
    var username = $("#username").val();
    var surname = $("#surname").val();
    var age = $("#age").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var password_cf = $("#password_cf").val();

    if (username == "" || surname == "" || age == "" || phone == "" || email == "" || password == "" || password_cf == "") {
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "",
            icon: "warning"
        });
    } else if (password !== password_cf) {
        Swal.fire({
            title: "รหัสผ่านไม่ตรงกัน",
            text: "กรุณาตรวจสอบรหัสผ่านและยืนยันรหัสผ่าน",
            icon: "error"
        });
    } else {
        $.ajax({
            url: 'api/adduser.php',
            type: 'POST',
            dataType: 'json',
            data: {
                username: username,
                surname: surname,
                age: age,
                phone: phone,
                email: email,
                password: password,
                password_cf: password_cf
            },
        })
        .done(function(result) {
            if (result.status == 'ok') {
                Swal.fire({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    icon: "success",
                    
                    didClose: () => {
                        $("#login").trigger('reset');
                        window.location.href = 'home.php';
                    }
                });
            } else {
                Swal.fire({
                    title: "บันทึกข้อมูลไม่สำเร็จ",
                    text: "",
                    icon: "error"
                });
            }
        })
        .fail(function() {
            
        })
        .always(function() {
			console.log("complete");
		});
    }
}


$(document).ready(function() {
    // Define the logoutuser function
    window.logoutuser = function() {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการออกจากระบบ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ออกจากระบบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Change to the logout page
                window.location.href = 'index.php';
            }
        });
    };
});
