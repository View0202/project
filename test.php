<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<div class="container mt-5">
    <!-- ประเมินใบหน้า -->
    <div class="tab-pane fade" id="pills-face" role="tabpanel" aria-labelledby="pills-face-tab">
        <div class="face">
            <div class="row justify-content-center">
                <span class="border border-secondary d-block bg-white rounded-3 shadow-lg" style="width: 1250px; height: 500px">
                <strong>การประเมินใบหน้า</strong>
                <div class="container mt-5">
                    
                    <div class="row">
                        <div class="col" align="right">
                            <a href="estimate.php" class="btn btn-primary">เพิ่ม</a>
                        </div>
                    </div>

                    <div class="row">
                        <table class="table" id="estimateData">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Manage</th>
                                </tr>
                            </thead>

                            <tbody id="content">
                                
                            </tbody>
                            
                        </table>
                    </div>

                </div>
                </span>
            </div>
        </div>
    </div> 
</div>

<script src="index.js"></script>
</body>
</html>
