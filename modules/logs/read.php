<?php   
    Api::$response->setResults(true,"Read logs successful");

    $sql = "select * from sys_logs";
    $result = Db::$connection->query($sql);

    $logs = $result->fetch_all(MYSQLI_ASSOC);

    Api::$response->data = $logs;
?>