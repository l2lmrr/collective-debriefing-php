<?php include 'header.php'; ?>
<?php include 'connection.php'; ?>

<h2>Admin Dashboard</h2>

<!-- Add User Button -->
<a href="add.php" class="btn btn-primary mb-3">Add User</a>

<!-- Display a table of users with options to edit or delete -->
<!-- Use Bootstrap table classes -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT u.id, u.username, u.fullname, r.name AS role_name FROM user u JOIN Role r ON u.role_id = r.id";
        $stmt = $PDO->prepare($query);
        $stmt->execute();
        
        $users = $stmt->fetchAll();  
        
        foreach ($users as $user) :
        ?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['username']?></td>
                <td><?=$user['fullname']?></td>
                <td><?=$user['role_name']?></td>
                <td>
                    <a href="edit.php?id=<?=$user['id']?>" class="btn btn-warning">Edit</a> |
                    <a href="delete.php?id=<?=$user['id']?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
