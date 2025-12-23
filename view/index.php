<?php
require_once "../controller/TaskController.php";

$controller = new TaskController();
$tasks = $controller->handleRequest();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-light">
                Task Management System
            </div>

            <div class="card-body">
                <form method="POST">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                    <button type="submit" name="add" class="btn btn-primary btn-sm mt-2">
                        Add Task
                    </button>
                </form>

                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $value) { ?>
                            <tr>
                                <td class="<?php echo ($value['status'] == 'completed') ? 'completed' : ''; ?>">
                                    <?php echo htmlspecialchars($value['title']); ?>
                                </td>
                                <td>
                                    <?php echo ucfirst($value['status']); ?>
                                </td>
                                <td>
                                    <a href="?update=1&id=<?php echo $value['id']; ?>"
                                        class="btn btn-success btn-sm">
                                        Update
                                    </a>
                                    <a href="?delete=1&id=<?php echo $value['id']; ?>"
                                        onclick="return confirm('Delete Task?')"
                                        class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>