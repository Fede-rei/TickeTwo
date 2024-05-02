<?php
    $type = 'mysql';
    $server = '127.0.0.1';
    $dbn = 'ticketwo';
    $port = '3306';
    $charset = 'utf8mb4';
    $username = 'root';
    $password = '';

    $options = [
        PDO::ATTR_ERRMODE               =>  PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    =>  PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      =>  false,
    ];

    $dsn = "$type:host=$server;dbname=$dbn;port=$port;charset=$charset";

    try{
        $db = new PDO($dsn, $username, $password, $options);
    }
    catch(PDOException $e){
        throw new PDOException($e->getMessage(), $e->getCode());
    }