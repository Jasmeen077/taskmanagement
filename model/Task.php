<?php
require_once "../config/config.php";

class Task extends Config
{

    // Add task
    public function addTask($title)
    {
        $title = trim($title);

        if (empty($title)) {
            echo "<script>alert('Title is required!');</script>";
            return false;
        }

        $title = $this->conn->real_escape_string($title);
        $sql = "INSERT INTO task (title, status) VALUES ('$title','pending')";

        if ($this->conn->query($sql)) {
            return true;
        } else {

            echo $this->conn->error;
            return false;
        }
    }


    // Get all tasks
    public function getTask()
    {
        $sql = "SELECT * FROM task ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // task status (toggle)
    public function doneTask($id)
    {
        $id = (int)$id;
        $sql = "UPDATE task 
                SET status = IF(status='pending','completed','pending') 
                WHERE id=$id";
        $this->conn->query($sql);
    }

    // Delete task
    public function deleteTask($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM task WHERE id=$id";
        $this->conn->query($sql);
    }


    //get task by id
    public function getTaskById($id)
    {
        $id = (int) $id;
        $sql = "SELECT * FROM task WHERE id=$id";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc() ?: null;
    }

    //update task
    public function updateTask($id, $title, $status)
    {
        $id = (int)$id;
        if ($id <= 0) {
            return false;
        }

        $title  = $this->conn->real_escape_string(trim($title));
        $status = $this->conn->real_escape_string(trim($status));

        $sql = "UPDATE task 
            SET title='$title', status='$status' 
            WHERE id=$id";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    //image upload
    public function uploadImage($file)
    {
        $imageName = $file['name'];
        $tmpName   = $file['tmp_name'];
        $path      = "../uploads/" . $imageName;

        if (move_uploaded_file($tmpName, $path)) {

            $sql = "INSERT INTO image_upload(image_url) VALUES ('$imageName')";

            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    //get image
    public function getImage()
    {
        $sql = "SELECT id, image_url FROM image_upload";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //delete image
    public function deleteImage($id)
    {
        $id = (int)$id;

        $sql = "SELECT image_url FROM image_upload WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result && $row = $result->fetch_assoc()) {

            $imagePath = "../uploads/" . $row['image_url'];

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $delete = "DELETE FROM image_upload WHERE id = $id";
            $this->conn->query($delete);
        }
    }

    //update image
    public function updateImage($id){
        $id = (int)$id;

        if($id <=0)
        {
            return false;
        }


        
    }
}
