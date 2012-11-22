<?php

# mozne syntaxe zapisu pri vkladani obsahu




# f.e. 1) vkladani textu

  $var_text = '## tohoto textiku ##';
  $var_cislo = 117648.97;

  echo 'spojeni 1) textu: '.$var_text.' a cisla: '.$var_cislo;

  echo str_repeat(PHP_EOL, 5);  //vlozeni 5x enter

  echo "spojeni 2) textu: {$var_text} a cisla: $var_cislo"; // { & } jsou pro prehlednost a pro slozitejsi konstrukte promennych jako jsou pole




# f.e. 2) vkladani souboru (vlozeni v miste volani)
  //@ == potlaceni chyby, vyvolat lze pomoci: error_get_last()

  # lze vkladat pomoci:
  # vklada se fyzicky kod ktery je vkladany na misto kde se vola include/require
  @include "cesta";
  //~ print_r(error_get_last());
  @include("cesta");

  //~ @require "cesta";

  //~ require("cesta");

  # omezeni na vlozeni pouze 1x, podobne jako v C "#pragma once"
  @include_once "cesta";

  //~ @require_once "cesta";

  echo str_repeat(PHP_EOL, 5);

  # Pozor rozdil mezi include a require!!!! funkce srovnatelna, ale jinak vyhodnocena chyba!




# f.e. 3) vkladani souboru (vlozeni tam kde chceme, trochu lip), potrebny soubor: 3_1_soubor.php
  # include / require muze fungovat jako bez-parametricka funkce

  $var_include = include "3_1_soubor.php";  // zpusobi to return

  echo "tady je nejaky vlozeny text(1): $var_include";

  echo str_repeat(PHP_EOL, 5);

  echo 'tady je nejaky vlozeny text(2): '.$var_include;




# f.e. 4) vkladani souboru pri tvorbe menu stranek
  # mame nejake odkazy ktere reprezentuji menu
  $page = 'home';

  # 4.1) horsi reseni (cesta pro kazdou stranu zvlast)
  switch ($page) {
    default:
      @include 'page/home.php';
    break;

    case 'kontakt':
      @include 'page/kontakt.php';
    break;

    case 'o-nas':
      @include 'page/o-nas.php';
    break;
  }




  # 4.2) o neco lepsi reseni, ale furt to neni vono
  $p = 'home';
  switch ($page) {
    default:
      $p = 'home';
    break;

    case 'kontakt':
      $p = 'kontakt';
    break;

    case 'o-nas':
      $p = 'o-nas';
    break;
  }
  //@include "page/$p.php";
  @include 'page/'.$p.'.php';  //samozrejme tu jeste bude overeni existence souboru




  # 4.3) lepsi reseni
  // definice stanek, vyhoda: lze podle tohoto pole generovat menu + lehke rozsireni o dalsi stranky
  $pages = array(
            'home' => 'home.php',
            'kontakt' => 'kontakt.php',
            'o-nas' => 'o-nas.php',
          );
  if (!empty($pages[$page])) {
    $load = $pages[$page];
  } else {
    $load = $pages['home'];
  }
  $kamkoliv = @include 'page/'.$load;  //samozrejme tu jeste bude overeni existence souboru




