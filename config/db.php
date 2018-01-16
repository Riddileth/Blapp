<?php



          $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(mysqli_connect_errno())
        {
                echo 'failed to connect' . mysqli_connect_errno();
        }

?>


