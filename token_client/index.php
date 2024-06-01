<?php
    $data_server = ["192.168.8.1", "192.168.8.2", "192.168.8.3", "192.168.8.4","192.168.8.5", "192.168.8.6", "192.168.8.7", "192.168.8.8"];
    
    $ch = curl_init();
	
    // Set cookie sesi

    foreach ($data_server as $key => $ds) {
        $key++;
        $url = "http://" . $ds . "/us24/panel/mod_jadwal/token.php";
        curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $token = curl_exec($ch);
        echo "SERVER $key <br> TOKEN : $token <br>";
        echo "<br>";
    }


	curl_close($ch);

?>
<a href="<?= $_SERVER['REQUEST_URI']; ?>update">Update</a>