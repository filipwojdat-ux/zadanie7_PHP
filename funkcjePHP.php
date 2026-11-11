<?php


const MAKS_PUNKTOW    = 100; 
const PROG_ZALICZENIA = 40;  


function obliczProcent($punkty)
{
    return ($punkty / MAKS_PUNKTOW) * 100;
}


function przyznajOcene($punkty)
{
    if ($punkty >= 90) {
        return 5;
    } elseif ($punkty >= 80) {
        return 4;
    } elseif ($punkty >= 60) {
        return 3;
    } elseif ($punkty >= 40) {
        return 2;
    } else {
        return 1;
    }
}


function czyZdal($punkty)
{
    return $punkty >= PROG_ZALICZENIA;
}
