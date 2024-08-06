//สมัครสมาชิก
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

//ออกจากระบบ
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

//เข้าสู่ระบบ
// $(document).ready(function () {
//     $("#loginuser").submit(function (event) {
//         event.preventDefault(); // Prevent the form from submitting the default way

//         var email = $("#email").val();
//         var password = $("#password").val();

//         if (email == "" || password == "") {
//             Swal.fire({
//                 icon: 'warning',
//                 title: 'กรุณากรอกข้อมูลให้ครบ',
//                 text: 'เบอร์โทรศัพท์และรหัสผ่าน'
//             });
//         } else {
//             $.ajax({
//                 url: 'api/checkuser.php',
//                 type: 'POST',
//                 dataType: 'json',
//                 data: {
//                     email: email,
//                     password: password
//                 },
//             })
//             .done(function(result) {
//                 if (result.status == 'ok') {
//                     Swal.fire({
//                         title: "เข้าสู่ระบบสำเร็จ",
//                         text: "",
//                         icon: "success",
//                         didClose: () => {
//                             $("#loginuser").trigger('reset');
//                             window.location.href = 'home.php';
//                         }
//                     });
//                 } else {
//                     Swal.fire({
//                         title: "เข้าสู่ระบบไม่สำเร็จ",
//                         text: result.message || "",
//                         icon: "error",
//                     });
//                 }
//             })
//             .fail(function() {
//                 Swal.fire({
//                     title: "เกิดข้อผิดพลาด",
//                     text: "",
//                     icon: "error",
//                 });
//             })
//             .always(function() {
//                 console.log("complete");
//             });
//         }
//     });
// });

//ประเมินใบหน้า
function saveestimate() {
    var detail = $("#detail").val();
    var formFile = $("#formFile")[0].files[0]; // รับไฟล์ที่อัพโหลด

    if (detail == "" || !formFile) {
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "",
            icon: "warning"
        });
    } else {
        var formData = new FormData();
        formData.append("detail", detail);
        formData.append("customer_id", $("#customer_id").val()); // รับ customer_id ถ้ามี
        formData.append("formFile", formFile);

        $.ajax({
            url: 'api/addestimate.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json'
        })
        .done(function(result) {
            if (result.status == 'ok') {
                Swal.fire({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    icon: "success",
                    didClose: () => {
                        $("#estimateForm").trigger('reset');
                        window.location.href = 'profile.php#pills-face';
                    }
                });
            } else {
                Swal.fire({
                    title: "บันทึกข้อมูลไม่สำเร็จ",
                    text: result.message || "",
                    icon: "error"
                });
            }
        })
        .fail(function() {
            Swal.fire({
                title: "เกิดข้อผิดพลาด",
                text: "",
                icon: "error"
            });
        })
        .always(function() {
            console.log("complete");
        });
    }
}

//อัพเดตข้อมูลส่วนตัว
function updateCustomer() {
    var name = $("#edit_name").val();
    var surname = $("#edit_surname").val();
    var email = $("#edit_email").val();
    var phone = $("#edit_phone").val();
    var age = $("edit_age").val();
    var password = $("#edit_password").val();
    var password_cf = $("#edit_password_cf").val();

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
            url: 'api/updatecustomer.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
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
                        $("#editCustomer").trigger('reset');
                        window.location.href = 'profile.php';
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


// ดึงข้อมูลจาก estimate
var html, data;

getData();

function getData() {
    $.ajax({
        url: 'api/getestimate.php',
        type: 'POST',
        dataType: 'json',
        data: {},
    })
    .done(function(result) {
        // ตรวจสอบผลลัพธ์ที่ได้จาก API
        console.log(result);

        if (result.status === 'success') {
            data = result.data;

            html = '';

            for (var i = 0; i < data.length; i++) {
                html += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${data[i].detail}</td>
                    <td><img src="${data[i].file}" alt="Image" width="100"></td>
                    <td>
                        <button class="btn btn-primary btn-sm">การตอบกลับ</button>
                    </td>
                </tr>
                `;
            }

            $('#content').html(html);
        } else {
            console.log("Failed to load data: " + result.message);
        }
    })
    .fail(function() {
        console.log("Error connecting to the API.");
    })
    .always(function() {
        console.log("Request complete.");
    });
}


















