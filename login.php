<h3>Login</h3>
<form action="includes/handlelogin.inc.php" method="post">
    <div>
        <label for="login-email">E-Mail:</label>
        <input type="text" name="login-email" id="login-email">
    </div>

    <div>
        <label for="login-password">Password:</label>
        <input type="password" name="login-password" id="login-password">
    </div>

    <div>
        <button type="submit" name="login-submit">Login</button>
    </div>
</form>

<?php 
    require 'signup.php';
?>