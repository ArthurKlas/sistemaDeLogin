<?php

require_once 'configDB.php';

//limpando dados de entrada

function verificar_entrada($entrada){
    $saida = trim($entrada);
    $saida = htmlspecialchars($saida);
    $saida = stripcslashes($saida);
    return $saida;
}

if(isset($_POST['action'])&& $_POST['action']=='registro'){
    $nomeCompleto = verificar_entrada($_POST['nomeCompleto']);
    $nomeUsuário = verificar_entrada($_POST['nomeUsuario']);
    $emailUsuário = verificar_entrada($_POST['emailUsuario']);
    $senhaUsuário = verificar_entrada($_POST['senhaUsuario']);
    $senhaUsuárioConfirmar = verificar_entrada($_POST['senhaUsuarioConfirmar']);
    $criado = date("y-m-d");
    echo $nomeCompleto."".$nomeUsuário . ""
            .$emailUsuário. "" . $senhaUsuário .""
            .$senhaUsuárioConfirmar."" ;
    $senha = sha1($senhaUsuário);
    $senhaConfirmar = sha1($senhaUsuárioConfirmar);
    
    //echo "Hash:" .$senha;
    
    if($senha != $senhaConfirmar){
        echo "As senhas não ";
        exit();
    }else{
        $sql = $conexão->Prepare("SELECT nomeUsuario,email FROM usuario WHERE nomeUsuario = ? OR  email = ?");
        $sql-> bind_param("ss",$nomeUsuário,$emailUsuário);
        $sql-> execute();
        $resultado = $sql->get_result();
        $linha = $resultado-> fetch_array(MYSQLI_ASSOC);
        if($linha['nomeUsuário']== $nomeUsuário)
            echo "Nome($nomeUsuário) indisponivel.";
        elseif($linha['email']== $emailUsuário)
            echo "E-mail ($emailUsuário) indisponivel.";
        else{
            $sql = $conexão->prepare("INSERT INTO usuario "."(nome,nomeUsuario,email,senha,criado)"."Values(?,?,?,?,?)");
            $sql-> bind_param("sssss",$nomeCompleto,$nomeUsuário,$emailUsuário,$senha,$criado);
            if($sql->execute()){
                echo "Cadastro com sucesso!";
            }else{
                echo"Algo deu Errado. por favor, tente novamente.";
            }
               
        }
    }
    
}