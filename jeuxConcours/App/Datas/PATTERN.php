<?php

const PATTERN = [
    "nom" => [
        "pattern" => "^[a-zA-Z-' ]*$",
        "need" => true
        ], #true obligatoire, false non obligatoire
    "prenom" => [
        "pattern" => "^[a-zA-Z-' ]*$",
        "need" => true
        ],
    "date_naissance" => [
        "pattern" => "^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$",
        "need" => false
        ],            
    "email" => [
        "pattern" => "^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$",
        "need" => true
        ],
    "code_postal" => [
        "pattern" => "^[0-9]{5}$",
        "need" => true
        ],
    "telephone" => [
        "pattern" => "^0[1-9][0-9]{8}$",
        "need" => false
        ]            
];
?>