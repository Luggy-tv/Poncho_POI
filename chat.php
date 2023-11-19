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
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"></a>

        <img src="/storage/<?php echo $row['img']; ?>" alt="">

        <div class="details">
          <span>
            <?php echo $row['fname'] . " " . $row['lname'] ?>
          </span>
          <p>
            <?php echo $row['status']; ?>
          </p>


        </div>

        <div style="margin-left: 30%; display: flex;" class="btn">

          <button type="button" onclick="obtenerLocalizacion()"
            style="border: none; outline: none; padding: 10px; margin-right: 10px; border-radius: 5px; background-color: #333; color: #fff; cursor: pointer;">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            Localizacion
          </button>

          <button type="button" onclick="abrirModal()"
            style="border: none; outline: none; padding: 10px; margin-right: 10px; border-radius: 5px; background-color: #333; color: #fff; cursor: pointer;">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            Correo
          </button>

        </div>


      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>

        <input type="text" name="message" id="messageInput" class="input-field" placeholder="Escriba el mensaje aqui..."
          autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>

      </form>
    </section>
  </div>


  <!-- Modal -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="cerrarModal()">&times;</span>
      <h2>Enviar Correo a
        <?php echo $row['fname'] . " " . $row['lname'] ?>:
      </h2>
      <form id="correoForm">
        <input type="text" id="incoming_id" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" placeholder="Asunto..." required>
        <br>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" placeholder="..." required></textarea>

        <button type="button" style="margin-top:30px; border-radius:3px" onclick="enviarCorreo()">Enviar</button>
      </form>
    </div>
  </div>


  <script src="javascript/chat.js"></script>

</body>

</html>