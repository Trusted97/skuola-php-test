<?php

define('DEBUG', true);


//Genero una stringa randomica di lunghezza 1024
function generateRandomString($length = 1024)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function analyzeAndCheckString($first_string, $second_string)
{
    $arr_str1 = str_split($str1);
    $arr_str2 = str_split($str2);

    if (DEBUG) {
        // DEBUG:
        echo "\n";
        echo "\n";
        echo "\n";
        print_r(array_count_values($arr_str1));
        echo "\n";
        echo "\n";
        echo "\n";
        print_r(array_count_values($arr_str2));
        echo "\n";
        echo "\n";
        echo "\n";
    }

    $count_val_arr1 = array_count_values($arr_str1);
    $count_val_arr2 = array_count_values($arr_str2);
}


if (isset($argv[1]) && isset($argv[2])) {
    echo "Stringhe settate.\n";

    //Copiare e incollare ogni volta dal terminale le stringhe era noioso cortocircuito per il momento
    //Lower the string, never trust user input
    //$str1 = strtolower($argv[1]);
    //$str2 = strtolower($argv[2]);

    $str1 = strtolower(generateRandomString());
    $str2 = strtolower(generateRandomString());

    echo $str1;


    //Se le stringhe sono uguali allora l'anagramma di una stringa è contenuto in un'altra stringa
    if ($str1 == $str2) {
        echo "Vero.\n";
    }

    analyzeAndCheckString($str1, $str2);
} else {
    echo "Stringhe mancanti.\n";
}
