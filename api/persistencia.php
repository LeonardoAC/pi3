<?php

function persistencia_conectaBD($flag){
    /*
        Funcao genérica, usada para conectar e desconectar o Banco de dados
    */
    $servername = "localhost";
    $username   = "leonardo";
    $password   = "AaBbCc789!!!";
    $db         = "db_pi3";
    if ($flag == "conecta"){
        // Cria conexao ao banco
        $conn = mysqli_connect($servername, $username, $password, $db);
        if (!$conn) {
            die("Falhou conexao ao BD: " . mysqli_connect_error());
        }else{
            return $conn; // retorna o objeto da conexao
        }
    //
    } elseif($flag == "desconecta"){
        // Interrompe a conexao
        mysqli_close($conn);
    }
}

function persistencia_checaSeExisteUserEmTb_user($user, $passwd){
    // Se usuário administrativo existir na tabela, retorna true. Caso não, false.
    $conn = persistencia_conectaBD("conecta");
    $query = "SELECT user_id, user_senha FROM tb_user WHERE user_id = '$user' AND user_senha = '$passwd'";
    return (mysqli_num_rows(mysqli_query($conn, $query)) > 0) ? (true) : (false);
    persistencia_conectaBD("deconecta");
}

function persistencia_checaSeExisteUserEmTb_player($rg_escolar){
    // Se jogador existe na tabela, retorna...
    $conn = persistencia_conectaBD("conecta");
    $query = "SELECT * FROM tb_player WHERE player_rgescolar = '$rg_escolar'";
    return ( mysqli_num_rows(mysqli_query($conn, $query)) > 0) ? (true) : (false);
    persistencia_conectaBD("deconecta");
}

function persistencia_ExecutaSelectGenerico($query){
    // As queries são criadas pelas functions "chamadoras".
    // Retorna os dados da consulta em um array se houver sucesso. False como insucesso.
    $conn = persistencia_conectaBD("conecta");
    if ($arrayDados = mysqli_fetch_array(mysqli_query($conn, $query))){
        return $arrayDados;
    }else{
        return false;
    }
    persistencia_conectaBD("deconecta");
}

function persistencia_ExecutaSelectGenericoComMultiplasTuplas($query){
    // As queries são criadas pelas functions "chamadoras".
    // Retorna os dados da consulta em um array se houver sucesso. False como insucesso.
    $conn = persistencia_conectaBD("conecta");
    $output = NULL;
    if ($output = mysqli_query($conn, $query)){
            while ($row = mysqli_fetch_array($output, MYSQLI_ASSOC)){
                // Popula o array com todos as tuplas da tabela
                $arrayDados[] = $row;
            } // while
        return ( !empty($arrayDados) ) ? ($arrayDados) : (false);
        //echo var_dump($arrayDados);
    }else{
        // A table está vazia
        return false;
    }
    persistencia_conectaBD("deconecta");
}

function persistencia_ExecutaInsertGenerico($queryDeInsert, $qryDeRetonoID){
    // As queries são criadas pelas functions "chamadoras".
    // Retorna os dados da inserção em um array se houver sucesso. False como insucesso.
    $conn = persistencia_conectaBD("conecta"); // Retorna o objeto da conexao
    if (mysqli_query($conn, $queryDeInsert)){
        $id = mysqli_insert_id($conn); // Retorna o ID do ultimo insert
        //echo "ID [".$id."] ";
        $arrayDados = mysqli_fetch_array(mysqli_query($conn, $qryDeRetonoID.$id)); // recupera o dado inserido
        return $arrayDados;
    }else{
        return false;
    }
    persistencia_conectaBD("deconecta"); // desconecta do BD
}

persistencia_conectaBD("deconecta");
?>