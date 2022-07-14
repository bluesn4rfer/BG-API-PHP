<?php
    /* BEGIN SQL TRANSACTION */
    Db::beginTransaction();

    /* PREPARE SQL STATEMENT */
    $create_table_sql = Db::$connection->prepare("CREATE TABLE $table_name (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `created` datetime DEFAULT CURRENT_TIMESTAMP,
        `modified` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    )");
    if($create_table_sql == false){
        Api::$response->setResults(false,"Create table prepare query failed: ".Db::prepareError());
        return;
    }

    /* SETUP VARIABLES */
    $table_name = 'shit'; //Api::$request->json->name;

    /* BIND PARAMETERS FOR SQL STATEMENT */
    $create_table_sql->bind_param("s", $name);

    /* EXECUTE QUERY */
    if(!$create_table_sql->execute()){
        Db::rollBack();
        Api::$response->setResults(false,"Create table failed: Rolled back");
        return;
    }

    /* END TRANSACTION */
    Db::endTransaction();
?>