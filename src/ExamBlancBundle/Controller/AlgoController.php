<?php

namespace ExamBlancBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlgoController extends Controller
{
    //////////////////////////////////////
    // Complète les fonctions suivantes //
    //////////////////////////////////////

    // Exercice 1
    public function number_of_char($str)
    {
        $str = strtolower($str); // convertit ttes les lettres en minuscules
        $new_str = preg_replace('/[^a-z_]/', '', $str ); // remplace tous les caractères non compris en a et z par rien
        $str_arr = str_split($new_str); // convertit la chaine de caractère en tableau, 1 ligne = 1 lettre

        $count = array_count_values($str_arr);
        asort($count);
        return $count;

    }

    // Exercice 2
    public function panier($tab)
    {
        $panier = array(
            'total_ht' => 0,
            'total_discount' => 0,
            'total_tva5' => 0,
            'total_tva20' => 0,
            'total_ttc' => 0,
        );

        foreach ($tab as $article) {
            $totalHT = $remise = $tva5 = $tva20 = 0;
            $totalHT = $article['price_ht'] *  $article['qty'];

            if($article['qty'] >= 10){
                $remise = $totalHT *0.1;
            }elseif ($article['qty'] >= 3 ){
                $remise = $totalHT *0.05;
            }
            if($article['code_tva'] == 1){
                $tva5 = ($totalHT - $remise) * 0.05;
            }elseif ($article['code_tva'] == 2){
                $tva20 = ($totalHT - $remise) * 0.2;
            }
            $panier['total_ht'] += $totalHT - $remise;
            $panier['total_discount'] += $remise;
            $panier['total_tva5'] += $tva5;
            $panier['total_tva20'] += $tva20;
            $panier['total_ttc'] += $totalHT - $remise + $tva5 + $tva20;

        }
        foreach ($panier as $key=>$val){
            $arrondi_panier[$key] = round($val,2);
        }
        return $arrondi_panier;
    }
}