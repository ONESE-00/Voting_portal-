<?php 

    if ( isset($_POST['data']))
    {   
        $data = $_POST['data'];
        echo "DATA HAS ARRIVED";
        echo "<br>".$data;
    }
    else {
        echo "SOMETHING WRONG";
    }
    echo "<br>"."HELLO ONESE"."<br>";
    var_dump($_POST);

?>

