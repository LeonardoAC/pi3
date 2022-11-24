<?php

function json_RetornoParaLoginUserDoSistema($retornoDeDados){
    /*
    foreach($retornoDeDados as $key => $value)
    {
      //echo '<p>['.$key."] valor: ". $value.'</p>';
      //echo "$value";
      echo "$value";
    }
*/
    if ($retornoDeDados == false){
        echo '{"msg":"BD nao retornou usuario do sistema."}';
    }else{
        echo '
        {
            "user": [
            {
                "id":"null",
                "nome":"'.$retornoDeDados["user_nome"].'",
                "acesso":"'.$retornoDeDados["user_nivel"].'",
                "foto":"'.$retornoDeDados["user_foto"].'"
            }
            ]
        }';
    } // $retornoDeDados ;
}

function json_RetornoListaPlayerUnico($retornoDeDados){
    if ($retornoDeDados == false){
        echo '{"msg":"BD nao inseriu jogador na table."}';
    }else{
        echo '
        {
            "user": [
            {
                "ID":"'.$retornoDeDados["player_codigo"].'";
                "Rg escolar":"'.$retornoDeDados["player_rgescolar"].'",
                "nome":"'.$retornoDeDados["player_nome"].'",
                "serie":"'.$retornoDeDados["player_serie"].'",
                "turma":"'.$retornoDeDados["player_turma"].'",
                "foto":"'.$retornoDeDados["player_foto"].'"
            }
            ]
        }';
    } // $retornoDeDados 
}

function json_RetornoListaTodosOsPlayers($retornoDeDados){
    if ($retornoDeDados == false){
        echo '{"msg":"BD nao retornou jogadores."}';
    }else{
        echo "{";
        //foreach($retornoDeDados as $key => $value)
        for($i=0; $i <= sizeof($retornoDeDados)-1; $i++)
        {
            //var_dump($retornoDeDados);
            echo '
            "user": [
            {
                "ID":"'.$retornoDeDados[$i]["player_codigo"].'";
                "Rg escolar":"'.$retornoDeDados[$i]["player_rgescolar"].'",
                "nome":"'.$retornoDeDados[$i]["player_nome"].'",
                "serie":"'.$retornoDeDados[$i]["player_serie"].'",
                "turma":"'.$retornoDeDados[$i]["player_turma"].'",
                "foto":"'.$retornoDeDados[$i]["player_foto"].'"
            }
            ]
        ';
        }
        echo "}";
    }// $retornoDeDados
}

?>