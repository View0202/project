<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload and Display</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="layouts/index.css">
</head>
<body>
    <div class="card" style="width: 500px; height: 300px; margin-left: 50px; margin-top: 20px;">
        <div class="img-container">
            <img id="displayImage" src="images/haman.png" class="card-img-top" alt="..." style="width: 200px; height: 200px;">
        </div>
        <div class="mb-3">
            <input class="form-control" type="file" id="formFile" style="width: 450px; margin-left: 25px;">
        </div>
    </div>

    <script src="index.js"></script>
</body>
</html>
