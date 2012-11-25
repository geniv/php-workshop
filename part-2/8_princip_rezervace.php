<?php exit;

# princip rezervace

/*

  Typ neni az tak dulezity ale jde pak o spracovani systemu vyhodnocovani.

  U rezervace se zpravidla uzivatel nekam/neco rezervuje nebo registruje.

  princip je ten ze je dostupny nejaky firmular ktery uzivatel vyplnuje
  (bud bude furt viditelny [kde muzou uzivatele svindlovat]) nebo se otevre az
  v zadanou dobu.

  Pote co uzivatel zada vstupni data, musi probehnout jejich validace a probehnout
  nezavisly dotaz do dazabaze jestli jeste neni prekrocena kapacita,
  pokud ne tak se potrebne udaje vlozi do databaze.

  Toto se opakuje vetsinou az do naplneni kapacity a pak se rezervace uzavrou nebo
  se skryje formular na rezervaci.

  Co se technicke stranky tyce je nutne zajistit aby se pri velkem naporu
  pri rezervaci zamikala tabulka respektive radky, kvuli mnoha pozadavkum
  ktere prichazi ve stejnou dobu.

  Tohle se nemusi resit pokud se do systemu registruje nekdo 1x za uhersky rok.

*/
