<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "config.php";
    $unique_id = $_SESSION['unique_id'];
    $sql = "SELECT email FROM users where unique_id = {$unique_id};";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $de = $row['email'];



    $data = json_decode(file_get_contents("php://input"), true);

    $asunto = $data["asunto"];
    $mensaje = $data["mensaje"];
    $incoming_id = $data["incoming_id"];

    $sql = "SELECT email FROM users where unique_id = {$incoming_id};";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $para = $row['email'];

    $encabezados = "From: " . $de;
    $encabezados .= "\r\nReply-To: " . $para;
    $encabezados .= "\r\nContent-Type: text/html; charset=UTF-8";

    if (mail($para, $asunto, $mensaje, $encabezados)) {
        print_r("success");
    } else {
        echo "Failure";
    }
    
    exit();

}

?>