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
        <section class="users">
            <header>
                <a href="creategroup.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

            </header>
            <div class="users-list-group">

            </div>
        </section>
    </div>
    <script src="javascript/groupuserlist.js"></script>

</body>

</html>