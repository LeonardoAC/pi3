<?php
    /*
        Leonardo A. Carrilho
        Outubro de 2022

        Rota: IP/user/{id}
    */

    require_once("persistencia.php");
    require_once("retorno-json.php");

    $const_segredo ="projetoUnivesp";

    function func_ChecaSeUserExiste($const_segredo){
        /*
        
        */
        $user   =   (isset($_GET['user'])   && !empty($_GET['user']))   ? ($_GET['user'])   : (false);
        $passwd =   (isset($_GET['passwd']) && !empty($_GET['passwd'])) ? ($_GET['passwd']) : (false);
        // criptografa os dados
        $userEncrypted    = crypt($user, $const_segredo);
        $passwdEncrypted  = crypt($passwd, $const_segredo);
        // Confere se argumentos estão vazios
        if ($user != false && $passwd != false){
            $query="
                SELECT user_nome, user_nivel, user_funcao, user_foto 
                FROM tb_user 
                WHERE user_id = '$userEncrypted' AND user_senha = '$passwdEncrypted'
            ";
            // Login do usuario do sistema administrativo
            (persistencia_checaSeExisteUserEmTb_user($userEncrypted, $passwdEncrypted)) ? (json_RetornoParaLoginUserDoSistema(persistencia_ExecutaSelectGenerico($query))) : (json_RetornoParaLoginUserDoSistema(false));
            // Login do player (aluno)
            //(persistencia_checaSeExisteUserEmTb_player($userEncrypted, $passwdEncrypted)) ? (json_RetornoListaPlayerUnico(persistencia_ExecutaSelectGenerico($query))) : (json_RetornoListaPlayerUnico(false));
        } else {
            echo '{"msg":"User e/ou senha vazios!"}';           
        }
    }


    function func_AtualizaRegistroDoUser($const_segredo){
        /*
        
        */

    }

    function func_ExcluiUserDaTabela($const_segredo){
        /*
        
        */

    }

    /*
        ********** I N I C I O ********
    */
    // Verifica o método (POST, GET, DELETE, PUT) e encaminha para o bloco adequado
    switch ($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            func_ChecaSeUserExiste($const_segredo);
            break;
        case 'POST':
            func_InsereUmNovoUserNaTabelaDeJogador();
            break;
        case 'PUT':
            func_AtualizaRegistroDoUser($const_segredo);
            break;
        case 'DEL':
            func_ExcluiUserDaTabela($const_segredo);
            break;
    }

?>