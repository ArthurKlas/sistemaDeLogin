<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sistemadelogin";


$conexão = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($conexão -> connect_errno){
        die("Não foi possivel conectar ao banco de dados:". $conexão ->connect_error );
    
    }else {
        //echo ("Conectado com sucesso!")
    }



