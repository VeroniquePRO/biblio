<?php
include "header.php";
?>
<?php
if (isset($_SESSION['users'])) {
    echo "vous etes bien connecté !";
}
else {


?>
<h1>Log in</h1>
<hr>
<?php
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
}
?>
<form action="connexion.php" method="POST">
    <input type="text" name="login" placeholder="Login">
    <input type="password" name="password" placeholder="Password">
    <input type="submit">
</form>
<?php
}
?>
</body>
</html>