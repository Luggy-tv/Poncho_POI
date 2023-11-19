<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "    SELECT * from messages as m left join `users` as u on  m.outgoing_msg_id = u.unique_id where incoming_msg_id = {$incoming_id}  ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <div class="groupchat_icon">
                                    <img src="/storage/'.$row['img'].'" alt=""> 
                                    <p> '.$row['fname'].' </p>
                                </div>
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No se han enviado mensajes. Empieza la conversacion!</div>';
        }
        echo $output;
    }else{
        header("location: ../index.php");
    }
?>