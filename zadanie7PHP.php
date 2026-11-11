<?php

require_once 'funkcje.php';

$uczniowie = [
    ["imie" => "Adam",  "punkty" => 85],
    ["imie" => "Kasia", "punkty" => 92],
    ["imie" => "Marek", "punkty" => 48],
    ["imie" => "Ola",   "punkty" => 67],
    ["imie" => "Tomek", "punkty" => 35]
];

$zaliczyli = [];
$niezaliczyli = [];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Raport wyników testu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .strona {
            width: 450px;
            margin: 0 auto;
            background-color: white;
            padding: 20px 30px;
            border: 1px solid #ccc;
        }
        h1 {
            font-size: 22px;
            text-align: center;
        }
        h2 {
            font-size: 18px;
            text-align: center;
        }
        .uczen {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .uczen h3 {
            margin: 0 0 5px 0;
        }
        .uczen p {
            margin: 2px 0;
        }
        .zaliczony {
            color: green;
            font-weight: bold;
        }
        .niezaliczony {
            color: red;
            font-weight: bold;
        }
        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="strona">

    <h1>RAPORT WYNIKÓW TESTU INFORMATYCZNEGO</h1>

    <?php
    foreach ($uczniowie as $uczen) {
        $imie = $uczen["imie"];
        $punkty = $uczen["punkty"];
        $zdal = czyZdal($punkty);

        if ($zdal) {
            $zaliczyli[] = $imie;
        } else {
            $niezaliczyli[] = $imie;
        }
    ?>
        <div class="uczen">
            <h3><?= $imie ?></h3>
            <p>Punkty: <?= $punkty ?></p>
            <p>Procent: <?= obliczProcent($punkty) ?>%</p>
            <p>Ocena: <?= przyznajOcene($punkty) ?></p>
            <?php if ($zdal) { ?>
                <p>Status: <span class="zaliczony">ZALICZONY</span></p>
            <?php } else { ?>
                <p>Status: <span class="niezaliczony">NIEZALICZONY</span></p>
            <?php } ?>
        </div>
    <?php
    }

    $liczba = count($uczniowie);
    $suma = 0;
    for ($i = 0; $i < $liczba; $i++) {
        $suma = $suma + $uczniowie[$i]["punkty"];
    }
    $srednia = $suma / $liczba;

    switch (true) {
        case $srednia < 40:
            $komentarz = "Bardzo słaby wynik klasy";
            break;
        case $srednia < 60:
            $komentarz = "Wynik klasy jest niezadowalający";
            break;
        case $srednia < 80:
            $komentarz = "Dobry wynik klasy";
            break;
        default:
            $komentarz = "Bardzo dobry wynik klasy";
            break;
    }
    ?>

    <hr>

    <h2>PODSUMOWANIE KLASY</h2>

    <p>Liczba uczniów: <?= $liczba ?></p>
    <p>Suma punktów: <?= $suma ?></p>
    <p>Średnia punktów: <?= $srednia ?></p>

    <p>Zaliczyło: <?= count($zaliczyli) ?></p>
    <p>Nie zaliczyło: <?= count($niezaliczyli) ?></p>
    <?php if (count($niezaliczyli) > 0) { ?>
        <p>Nie zaliczyli: <?= implode(", ", $niezaliczyli) ?></p>
    <?php } ?>

    <p><b>Komentarz: <?= $komentarz ?></b></p>

</div>
</body>
</html>
