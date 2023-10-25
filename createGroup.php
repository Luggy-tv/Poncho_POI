<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">

            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                Crear Grupo
            </header>
            <form action="./selectusers.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="name-details-group">
                    <div class="field input">
                        <label>Nombre Grupo </label>
                        <input type="text" name="fname" placeholder="Nombre" required>
                    </div>

                </div>
                <div class="field image">
                    <label>Seleciona imagen</label>
                    <input type="file" name="image" accept="image/x-png,image/jpeg,image/jpg" required>
                </div>
                <div class="user_invite">
                    <div class="name-details-group">
                        <label>Selecciona a los usuarios</label>
                    </div>
                    <div class="users-list">

                    </div>
                </div>

                <div class="field button">
                    <input type="submit" name="submit" value="Crear grupo">
                </div>
            </form>

        </section>
    </div>

    <script src="javascript/creategroup.js"></script>

</body>

</html>