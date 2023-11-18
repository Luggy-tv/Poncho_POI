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


        $sql = mysqli_query($conn, " SELECT g.group_id,   
                                      g.uniqueGroup_id as unique_id, 
                                      g.Group_name as fname,
                                      CASE WHEN g.Group_name IS NULL THEN ' ' ELSE ' ' END as lname , 
                                      g.img as img, 
                                      CASE WHEN g.Group_name IS NULL THEN 'Activo' ELSE 'Activo' end as `status`
                                      FROM `grupos` as g WHERE g.uniqueGroup_id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users.php");
        }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span>
            <?php echo $row['fname'] . " " . $row['lname'] ?>
          </span>
          <p>
            <?php echo $row['status']; ?>
          </p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escriba el mensaje aqui..."
          autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat_group.js"></script>

</body>

</html>