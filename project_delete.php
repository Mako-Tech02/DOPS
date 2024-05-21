<?php
include('includes/db.php'); // Include your database connection file
include('includes/session.php');

if(isset($_GET["id"])) {
    $project_id = $_GET["id"];

    // Begin a transaction
    $conn->begin_transaction();

    // Delete tasks associated with the project
    $delete_tasks_query = "DELETE FROM tasks WHERE project_id = '$project_id'";
    if ($conn->query($delete_tasks_query)) {
        // Tasks deleted successfully, now delete the project
        $delete_project_query = "DELETE FROM projects WHERE project_id = '$project_id'";
        if ($conn->query($delete_project_query)) {
            // Commit the transaction
            $conn->commit();
            $_SESSION["success"] = "Patient and associated symptom have been deleted.";
        } else {
            // Rollback the transaction on failure
            $conn->rollback();
            $_SESSION["error"] = "Error deleting patient: " . $conn->error;
        }
    } else {
        // Rollback the transaction on failure
        $conn->rollback();
        $_SESSION["error"] = "Error deleting associated sympton: " . $conn->error;
    }

    header("Location: projects.php"); // Redirect back to projects page
    exit();
} else {
    header("Location: projects.php"); // Redirect if no ID is provided
    exit();
}
?>
