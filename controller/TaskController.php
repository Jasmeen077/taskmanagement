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

        // Update task 
        if (isset($_POST['updatetask']) && isset($_GET['id'])) {
            $id     = $_GET['id'];
            $title  = $_POST['title'];
            $status = $_POST['status'];

            $this->task->updateTask($id, $title, $status);
            header("Location: index.php");
            exit;
        }

        // Get task by id 
        if (isset($_GET['get']) && isset($_GET['id'])) {
            return $this->task->getTaskById($_GET['id']);
        }

        // Delete task
        if (isset($_GET['delete']) && isset($_GET['id'])) {
            $this->task->deleteTask($_GET['id']);
            header("Location: index.php");
            exit;
        }

        // Done task
        if (isset($_GET['done']) && isset($_GET['id'])) {
            $this->task->doneTask($_GET['id']);
            header("Location: index.php");
            exit;
        }

        // Get all tasks
        return $this->task->getTask();
    }
}
