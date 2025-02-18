<html lang="ca">

<head>
    <title>Registre - TDIW</title>
</head>

<body>

    <?php require __DIR__ . '/controller/llistar_mensaje_registre.php'; ?>

    <div class="container">
        <form action="?action=registre-session" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="first_name">First name:</label><br>
            <input type="text" id="first_name" name="first_name"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="postal_code">Postal code:</label><br>
            <input type="text" id="postal_code" name="postal_code"><br>
            <input type="submit" value="Submit">
        </form>
        



</body>

</html>