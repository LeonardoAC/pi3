<?php
    /*
        Usado para criptografar os dados e inserir na tabela    
    */
    $const_segredo = "projetoUnivesp";
    $texto1 = "leo";
    $texto2 = "123";
    $texto3 = "mada";
    $texto4 = "123";
    $texto5 = "gina";
    $texto6 = "123";
    echo "<br>Leo   ".crypt($texto1, $const_segredo);
    echo "<br>senha ".crypt($texto2, $const_segredo);
    echo "<br>Mada  ".crypt($texto3, $const_segredo);
    echo "<br>senha ".crypt($texto4, $const_segredo);
    echo "<br>Gina  ".crypt($texto5, $const_segredo);
    echo "<br>senha ".crypt($texto6, $const_segredo);
?>