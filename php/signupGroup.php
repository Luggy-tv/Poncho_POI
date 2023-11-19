<?php
session_start();

include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);

if (isset($_SESSION['unique_id'])) {

    $outgoing_id = $_SESSION['unique_id'];

    if (!empty($fname) && isset($_FILES['image']) && isset($_POST['selected_users'])) {

        $selectedUserIds = explode(',', $_POST['selected_users']);
        $selectedUserIds[] = $outgoing_id;

        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);
        $extensions = ["jpeg", "png", "jpg"];
        if (in_array($img_ext, $extensions) === true) {
            $time = time();
            $new_img_name = $time . $img_name;
            if (move_uploaded_file($tmp_name, $img_path. $new_img_name)) {

                $ran_id = rand(time(), 100000000);

                $insert_query = mysqli_query($conn, "INSERT INTO `grupos`(uniqueGroup_id,Group_name,img) VALUES ({$ran_id},'{$fname}','{$new_img_name}')");


                if ($insert_query) {

                    $select_sql2 = mysqli_query($conn, "SELECT * FROM `grupos` WHERE uniqueGroup_id = '{$ran_id}'");

                    if (mysqli_num_rows($select_sql2) > 0) {

                        $row = $select_sql2->fetch_assoc();
                        $group_id = $row["group_id"];

                        foreach ($selectedUserIds as $userId) {

                            $insertRelationQuery = mysqli_query($conn, "INSERT INTO `groups_users` (uniqueUser_id, uniqueGroup_id) VALUES ('{$userId}', '{$ran_id}')");

                            if (!$insertRelationQuery) {
                                echo "Error al asociar usuarios al grupo. Por favor, vuelva a intentarlo.";
                            }

                        }
                        echo "success";


                    } else {
                        echo "Ha habiedo un error en la base de datos favor de volverlo a intentar, error 44";
                    }
                } else {
                    echo "Ha habido un error en la base de datos favor de volverlo a intentar, error 49";
                }
            } else {
                echo "Ha habido un error con la imagen favor de volverlo a intentar";
            }
        } else {
            echo "Formato de Imagen no valido, favor de volver a intentarlo";
        }

    } else {

        echo "Campos incompletos, vuelvalo a intentar";
    }

} else {
    echo "Hay un problema con la pagina fabor de volverla a cargar.";
}

?>