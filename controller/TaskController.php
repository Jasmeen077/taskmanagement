<?php
require_once "../model/Task.php";

class TaskController
{
    private $task;

    public function __construct()
    {
        $this->task = new Task();
    }

    public function handleRequest()
    {
        // Add task
        if (isset($_POST['add'])) {
            $this->task->addTask($_POST['title']);
            header("Location: index.php");
            exit;
        }

        // Delete task
        if (isset($_GET['delete']) && isset($_GET['id'])) {
            $this->task->deleteTask($_GET['id']);
            header("Location: index.php");
            exit;
        }

        // Update status
        if (isset($_GET['update']) && isset($_GET['id'])) {
            $this->task->updateTask($_GET['id']);
            header("Location: index.php");
            exit;
        }

        // Get all tasks
        $tasks = $this->task->getTask();
        return $tasks;
    }
}
