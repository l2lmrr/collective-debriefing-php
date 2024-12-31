<?php 
include 'header.php'; 
include 'connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $role_id = $_POST['role'];

    if (!empty($fullname) && !empty($username) && !empty($role_id)) {
        $password = password_hash("defaultpassword", PASSWORD_BCRYPT);  
        $query = "INSERT INTO user (fullname, username, password, role_id) VALUES (:fullname, :username, :password, :role_id)";
        $stmt = $PDO->prepare($query);
        
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);  
        $stmt->bindParam(':role_id', $role_id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>User added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding user.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Please fill all the fields.</div>";
    }
}

$roleQuery = "SELECT * FROM Role"; 
$roleStmt = $PDO->prepare($roleQuery);
$roleStmt->execute();
$roles = $roleStmt->fetchAll();

?>

<h2>Add User</h2>

<form method="post" action="">
    <div class="form-group">
        <label for="fullname">Fullname:</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
    </div>

    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
        <select name="role" id="role" class="form-control" required>
            <option value="">Select Role</option>
            <?php foreach ($roles as $role) : ?>
                <option value="<?= $role['id']; ?>"><?= $role['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Add User</button>
</form>

<?php include 'footer.php'; ?>
