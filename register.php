<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
}
?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="Nombres" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Apellidos" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Correo" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Crear usuario">
        </div>
      </form>
      <div class="link">Ya tienes cuenta? <a href="index.php">Inicia sesion</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>

</html>