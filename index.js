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

$(document).ready(function () {
    $("#loginuser").submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting the default way

        var phone = $("#phone").val();
        var password = $("#password").val();

        if (phone === "" || password === "") {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณากรอกข้อมูลให้ครบ',
                text: 'เบอร์โทรศัพท์และรหัสผ่าน'
            });
        } else {
            $.ajax({
                url: 'api/checkuser.php', // Correct the URL here
                type: 'POST',
                dataType: 'json',
                data: {
                    phone: phone,
                    password: password
                },
            })
            .done(function(result) {
                if (result.success) { // Changed to check 'success' instead of 'status'
                    Swal.fire({
                        title: "เข้าสู่ระบบสำเร็จ",
                        text: "",
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
            })
            .fail(function() {
                Swal.fire({
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้",
                    icon: "error",
                });
            });
        }
    });
});



document.addEventListener("DOMContentLoaded", function() {
    var tabEl = document.querySelectorAll('button[data-bs-toggle="pill"]');
    tabEl.forEach(function(tab) {
        tab.addEventListener("shown.bs.tab", function(event) {
            var target = event.target.getAttribute("data-bs-target");
            var content = document.querySelector(target);
            var otherContents = document.querySelectorAll(".tab-pane");
            otherContents.forEach(function(otherContent) {
                if (otherContent !== content) {
                    otherContent.classList.remove("show", "active");
                }
            });
            content.classList.add("show", "active");
        });
    });
});

var id;

function openEditModal(index){
    $('#editUser').modal('show');

    $('#edit_id').val(data[index].emp_id); // Add this line
    $('#edit_username').val(data[index].username);
    $('#edit_surname').val(data[index].surname);
    $('#edit_age').val(data[index].age);
    $('#edit_phone').val(data[index].phone);
    $('#edit_email').val(data[index].email);
    $('#edit_password').val(data[index].password);
    $('#edit_password_cf').val(data[index].password_cf);
    id = data[index].emp_id;
}

function updateUser(){
    var username = $('#edit_username').val();
    var surname = $('#edit_surname').val();
    var age = $('#edit_age').val();
    var phone = $('#edit_phone').val();
    var email = $('#edit_email').val();
    var password = $('#edit_password').val();
    var password_cf = $('#edit_password_cf').val();
    var id = $('#edit_id').val(); // Add this line

    $.ajax({
        url: 'api/updateuser.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
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
                title: "แก้ไขข้อมูลสำเร็จ",
                text: "",
                icon: "success",
                didClose:() => {
                    getData();
                    $("#edituser").trigger('reset');
                    window.location.href = 'home.php';
                }
            });
        } else {
            Swal.fire({
                title: "แก้ไขข้อมูลไม่สำเร็จ",
                text: "",
                icon: "error",
            });
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}

