<?php
require_once "../controller/TaskController.php";

$controllerData = new TaskController();
$tasks = $controllerData->handleRequest();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-light">
                Update Tasks
            </div>
            <div class="card-body">
                <?php if ($tasks): ?>
                   <form method="POST" action="?id=<?= $tasks['id'] ?>">
                        <div class="mb-2">
                            <input type="text" name="title" class="form-control"
                                value="<?= htmlspecialchars($tasks['title']) ?>" required placeholder="Enter the title">
                        </div>
                        <div class="mb-2">
                            <select name="status" class="form-select">
                                <option value="pending" <?= $tasks['status'] == 'pending' ? 'selected' : '' ?>>
                                    Pending
                                </option>
                                <option value="completed" <?= $tasks['status'] == 'completed' ? 'selected' : '' ?>>
                                    Completed
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="updatetask">Update</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>