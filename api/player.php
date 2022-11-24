<?php
    /*
        Leonardo A. Carrilho
        Outubro de 2022

        Rota: IP/user/player{id}
    */

    require_once("persistencia.php");
    require_once("retorno-json.php");

    $const_segredo ="projetoUnivesp";

    function func_ProcuraSeRgEscolarExisteAntesDeInserirUserNaTabela(){
        return false;
    }

    function func_listaOsPlayers(){
        // Se ID está informado - retona o player específico;
        // Se não há ID - retorna todos os players
        ( isset($_GET['rg_escolar']) && !empty($_GET['rg_escolar']) ) ? ( $rg_escolar = $_GET['rg_escolar'] ) : ($rg_escolar = "null");
        $querySeExistePlayer = "
            SELECT * FROM tb_player WHERE player_rgescolar = $rg_escolar";
        $queryListaTodosPlayers = "
            SELECT * FROM tb_player";
        if ($rg_escolar != "null"){
            // Retorna um player em especifico
            ( persistencia_checaSeExisteUserEmTb_player($rg_escolar) ) ? ( json_RetornoListaPlayerUnico(persistencia_ExecutaSelectGenerico($querySeExistePlayer)) ) : (json_RetornoListaPlayerUnico(false));
        } else {
            // Retorna todos os players existentes
            json_RetornoListaTodosOsPlayers(persistencia_ExecutaSelectGenericoComMultiplasTuplas($queryListaTodosPlayers));
        }
    }

    function func_InsereUmNovoPlayerNaTabela(){
        /*
        
        */
        // Os operadores ternários verificam se há o argumento e ele não está vazio. Em caso true, recupera os dados.
        $rg_escolar     = (isset($_POST['rg_escolar']  )    && !empty($_POST['rg_escolar']))    ? ($_POST['rg_escolar'])    : (false);
        $nome           = (isset($_POST['nome']        )    && !empty($_POST['nome']))          ? ($_POST['nome'])          : (false);
        $dt_nascimento  = (isset($_POST['dt_nascimento'])   && !empty($_POST['dt_nascimento'])) ? ($_POST['dt_nascimento']) : (false);
        $serie          = (isset($_POST['serie']       )    && !empty($_POST['serie']))         ? ($_POST['serie'])         : (false);
        $turma          = (isset($_POST['turma']       )    && !empty($_POST['turma']))         ? ($_POST['turma'])         : (false);
        $periodo        = (isset($_POST['periodo']     )    && !empty($_POST['periodo']))       ? ($_POST['periodo'])       : (false);
        $foto           = (isset($_POST['foto']        )    && !empty($_POST['foto']))          ? ($_POST['foto'])          : (false);
        
        $rg_escolar     = filter_var($rg_escolar,       FILTER_SANITIZE_ADD_SLASHES);
        $nome           = filter_var($nome,             FILTER_SANITIZE_ADD_SLASHES);
        $dt_nascimento  = filter_var($dt_nascimento,    FILTER_SANITIZE_ADD_SLASHES);
        $serie          = filter_var($serie,            FILTER_SANITIZE_ADD_SLASHES);
        $turma          = filter_var($turma,            FILTER_SANITIZE_ADD_SLASHES);
        $periodo        = filter_var($periodo,          FILTER_SANITIZE_ADD_SLASHES);
        $foto           = filter_var($foto,             FILTER_SANITIZE_ADD_SLASHES);

        $qryParaInserir = 
            "
                INSERT INTO tb_player(
                    player_codigo, player_rgescolar, player_rguf, player_nome, player_dtnascimento, player_serie, player_turma, player_periodo, player_foto, player_ativo
                    )
                VALUES(
                    NULL , '$rg_escolar' , 'sp' , '$nome' , '$dt_nascimento' , '$serie' , '$turma' , '$periodo' , '$foto' , '1'
                    )
            ";

        $qryParaRecuperarRegistroInserido = "SELECT * FROM tb_player WHERE player_codigo =  "; // o ID é concatenado na persistencia
        
        (func_ProcuraSeRgEscolarExisteAntesDeInserirUserNaTabela($rg_escolar)) ? (false) : (json_RetornoListaPlayerUnico(persistencia_ExecutaInsertGenerico($qryParaInserir, $qryParaRecuperarRegistroInserido)));
    }

    function func_AtualizaRegistroDoPlayer(){
        /*
        
        */

    }

    function func_ExcluPlayerDaTabela(){
        /*
        
        */

    }

    /*
        ********** I N I C I O ********
    */
    // Verifica o método (POST, GET, DELETE, PUT) e encaminha para o bloco adequado
    switch ($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            func_listaOsPlayers();
            break;
        case 'POST':
            func_InsereUmNovoPlayerNaTabela();
            break;
        case 'PUT':
            func_AtualizaRegistroDoPlayer();
            break;
        case 'DEL':
            func_ExcluPlayerDaTabela();
            break;
    }

?>