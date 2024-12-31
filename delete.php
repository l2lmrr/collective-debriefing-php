<?php 
include 'header.php';
include 'connection.php'; 
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "DELETE FROM user WHERE id = :id";
    $stmt = $PDO->prepare($query);
    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>User deleted successfully!</div>";
        header('dashboard.php'); 
    } else {
        echo "<div class='alert alert-danger'>Error deleting user.</div>";
    }
    header('dashboard.php'); 
    exit;
}
?>

<?php include 'footer.php'; ?>
