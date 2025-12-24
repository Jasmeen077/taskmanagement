<?php
require_once "../controller/TaskController.php";

$controller = new TaskController();
$data = $controller->handleRequest();
$images = $data['images'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Inserted into Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header bg-secondary text-light">
                Upload Image
            </div>

            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="image_url">Select Image</label>
                    <input type="file" class="form-control" name="image_url" required>
            </div>

            <div class="card-footer bg-light">
                <button type="submit" class="btn-sm btn btn-primary" name="uploadimage">
                    Upload Image
                </button>
            </div>
            </form>
            <div class="conatiner">
                <div class="card">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Feature Image</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            <?php

                            foreach ($images as $image) {
                            ?>
                                <tr>
                                    <td>
                                        <img src="../uploads/<?php echo $image['image_url'] ?>" width="100px" height="auto">
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success">Update</a>
                                        <a href="?deleteimage=1&id=<?php echo $image['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('You want to delete image');">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>