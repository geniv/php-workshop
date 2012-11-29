<?php

# generovani xml
  # dokumentace: http://php.net/manual/en/book.simplexml.php
  # uziti: http://php.net/manual/en/simplexml.examples-basic.php

  $xml = new SimpleXMLElement('<moje></moje>');

  $xml->tvoje = 'ahoj';

  $sl = $xml->addChild('kategorie');

  foreach (range(0,10) as $row) {
    $node = $sl->addChild('itemy');
    //$xml->slozka->itemy[] = $row * 5;
    $node->addAttribute('vnitrni', 'mujatribut-'.$row);
    $node[] = $row * 5;
  }

  echo $xml->asXML();
