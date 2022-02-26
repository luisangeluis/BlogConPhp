<?php
    $str = 'hola holo hola';

    // echo str_replace('hola','a',$str);

    $str2 = 'mi mama me mima';

    $str2Tratado = preg_replace('/\s+/', '', $str2);

    echo $str2Tratado;
?>