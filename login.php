<?php include 'header.php'; ?>

<h2>Login</h2>
<!-- TODO: Add login form with input fields for username and password -->
<!---------------------------------------- -->
<!-- Login form -->
<form method="post" action="login_action.php">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include 'footer.php'; ?>
