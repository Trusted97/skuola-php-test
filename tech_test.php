<?php

define('DEBUG', false);


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
    //Calcolo la lunghezza delle stringhe
    $len_str1 = strlen($first_string);
    $len_str2 = strlen($second_string);

    //Le splitto per farle diventare array
    $arr_str1 = str_split($first_string);
    $arr_str2 = str_split($second_string);


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

    //Guardo quali caratteri sono più frequenti e capovolgo l'array in modo da poter usare max come chiave
    $count_val_arr1 = array_count_values($arr_str1);
    $count_val_arr2 = array_count_values($arr_str2);

    //Ordino in modo ascente in accordo con la key
    ksort($count_val_arr1);
    ksort($count_val_arr2);

    if (DEBUG) {
        print_r($count_val_arr1);
        print_r($count_val_arr2);
    }


    $max_lenght = 0; //Valore contente lunghezza stringa più lunga, inizializzato 0
    $min_lenght = 0; //Valore contente lunghezza stringa più corta, inizializzato 0

    $check = 0; //Flag adoperato per vedere se viene contenuto


    $anagram_found = false; //Flag adoperato per segnalare se un anagrama è stato trovato.


    //Calcolo quale stringa è più lunga
    if ($len_str1 > $len_str2) {
        $max_lenght = $len_str1;
        $min_lenght = $len_str2;
    } else {
        $max_lenght = $len_str2;
        $min_lenght = $len_str1;
    }

    //Il ciclo può essere effettuato per entrambi gli array.
    foreach ($count_val_arr1 as $key => $value) {
        /*
         * Controllo che esista almeno un occorrenza per ciascun carattere
         * in ciascuna stringa se la lunghezza della stringa più corta
         * è uguale a check vuol dire che contiene almeno
         * una occorrenza della stringa in una sua qualsiasi permutazione
         */
        if ($count_val_arr1[$key] >= 1 && $count_val_arr2[$key] >= 1) {
            $check++;
        }
    }

    if ($min_lenght == $check) {
        $anagram_found = true;
    }

    if ($anagram_found) {
        echo "Vero\n";
    } else {
        echo "Falso\n";
    }
}

//MAIN

if (isset($argv[1]) && isset($argv[2])) {
    echo "Stringhe settate.\n";

    //Copiare e incollare ogni volta dal terminale le stringhe era noioso cortocircuito per il momento
    //$str1 = strtolower(generateRandomString());
    //$str2 = strtolower(generateRandomString());


    //Lower the string, never trust user input
    $str1 = strtolower($argv[1]);
    $str2 = strtolower($argv[2]);



    //$str1 = 'itookablackcab';//strtolower(generateRandomString());
    //$str2 = 'abc';//strtolower(generateRandomString());




    //Se le stringhe sono uguali allora l'anagramma di una stringa è contenuto in un'altra stringa
    if ($str1 == $str2) {
        echo "Vero, stesse stringhe\n";
        die();
    }

    if (strlen($str1) > 1024 || strlen($str2) > 1024) {
        echo "Lunghezza massima superata\n";
        die();
    }


    analyzeAndCheckString($str1, $str2);

    if (DEBUG) {
        echo "DEBUG TEST";
        echo "EXPECTED VERO,FALSO,VERO";
        analyzeAndCheckString($str1 = 'abc', $str2 = 'itookablackcab'); //VERO
        analyzeAndCheckString($str1 = 'tre', $str2 = 'fred'); //FALSO
        analyzeAndCheckString($str1 = 'cat', $str2 = 'trewqtac'); //VERO
    }
} else {
    echo "Stringhe mancanti.\n";
}
