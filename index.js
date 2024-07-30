document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('login');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
    });
});

function savecustomer() {
    var name = $("#name").val();
    var surname = $("#surname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var age = $("#age").val();
    var password = $("#password").val();
    var password_cf = $("#password_cf").val();

    if (name == "" || surname == "" || email == "" || phone == ""  || age == ""  || password == "" || password_cf == "") {
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
            url: 'api/addcustomer.php',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                surname: surname,
                age: age,
                phone: phone,
                email: email,
                password: password
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
                        window.location.href = 'login.php';
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

$(document).ready(function () {
    $("#loginuser").submit(function (event) {
        event.preventDefault(); // ป้องกันฟอร์มจากการส่งข้อมูลแบบปกติ

        var email = $("#email").val();
        var password = $("#password").val();

        if (email === "" || password === "") {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณากรอกข้อมูลให้ครบ',
                text: 'อีเมล์และรหัสผ่าน'
            });
        } else {
            $.ajax({
                url: 'api/checkuser.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    email: email,
                    password: password
                },
                success: function(result) {
                    if (result.success) {
                        Swal.fire({
                            title: "เข้าสู่ระบบสำเร็จ",
                            icon: "success",
                            didClose: () => {
                                $("#loginuser").trigger('reset');
                                window.location.href = 'home.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "เข้าสู่ระบบไม่สำเร็จ",
                            text: result.message || "เกิดข้อผิดพลาดในการเข้าสู่ระบบ",
                            icon: "error",
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้",
                        icon: "error",
                    });
                }
            });
        }
    });
});

//รูปภาพใบหน้า
document.getElementById('formFile').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('displayImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});






