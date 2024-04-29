<?php
include "header.php";
?>

<h1>Nouvel utilisateur</h1>
<hr>
<form action="sauvegardeutilisateur.php" method="POST">
    <input type="text" name="login" placeholder="Login">
    <input type="text" name="password" placeholder="Password">
    <input type="submit">
</form>
</body>
</html>