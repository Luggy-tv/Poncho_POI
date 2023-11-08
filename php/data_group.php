<?php

// print_r($query2);
while ($row = mysqli_fetch_assoc($querye)) {

    //     print_r("<br> grupo <br>");
    //  print_r($row);

    
    $sql2 = "SELECT * from messages as m left join `users` as u on  m.outgoing_msg_id = u.unique_id where incoming_msg_id = {$row['unique_id']}  ORDER BY msg_id desc Limit 1";

    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No se han mandado mensajes";
    (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;

    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Tu: " : $you = $row2['fname'].": ";
    } else {
        $you = "";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="chat_group.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
                
}

?>