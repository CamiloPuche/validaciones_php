<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="index.css">
    <title>Login</title>

</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="index.php?controller=login&action=validar" method="post">
                    <h2>Login</h2>
                    <?php include_once 'C:\xampp\htdocs\validaciones_php\Controller\loginController.php'  ?>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="user" id="user" required>
                        <label for="">User</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" id="password" required>
                        <label for="">Password</label>
                    </div>
                    <button type="submit" value="Iniciar sesión">Log in</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>