<?php

# string funkce
  // vice viz manual: http://php.net/manual/en/ref.strings.php

  # zajimave funkce


  # lomitka
    $str = "Is your name O'reilly?";
    var_dump(addslashes($str)); // dosazeni lomitek

    var_dump(stripslashes(addslashes($str))); // odstraneni lomitek


  # rozdeleni textu
    $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";

    $pieces = explode(' ', $pizza);

    print_r($pieces);

    var_dump(implode('::', $pieces));


  # prevod html
    $orig = 'I\'ll "walk" the <b>dog</b> now';

    $a = htmlentities($orig); // prevod na entity
    var_dump($a);

    $b = html_entity_decode($a);  // prevod z entit
    var_dump($b);


  # uvozovky
    $str = "this -&gt; &quot;";

    var_dump(htmlspecialchars_decode($str));

    var_dump(htmlspecialchars_decode($str, ENT_NOQUOTES));


  # trim varianty
    $text = "\t\tThese are a few words :) ...  ";
    var_dump(ltrim($text)); // left trim

    var_dump(rtrim($text)); // right trim

    var_dump(trim($text));  // normal trim


  # substituce jako v C
    $num = 5;
    $location = 'tree';

    $format = 'There are %d monkeys in the %s';
    var_dump(sprintf($format, $num, $location));  // substituce do textu, predane po jednom

    var_dump(vsprintf($format, array($num, $location)));  // predane polem


  # opakovani textu
    var_dump(str_repeat("-=", 10));


    # nahrazovani v textu
    var_dump(str_replace("%body%", "black", "<body text='%body%'>"));

    $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
    var_dump(str_replace($vowels, "", "Hello World of PHP"));


  # delka textu
    $str = 'žluťoučký kůň';
    # pocita s obycejnym textem
    var_dump(strlen($str)); // neakceptuje diakritiku

    # pocita s textem dle zadaneho charsetu
    # viz vice info o multibyte string: http://www.php.net/manual/en/ref.mbstring.php
    var_dump(mb_strlen($str, 'UTF-8')); //akceptuje diaktritiku


  # lower case
    $str = "Mary Had A Little Lamb and She LOVED It So";
    var_dump(strtolower($str));

  # upper case
    var_dump(strtoupper($str));

  # substring
    var_dump(substr("abcdef", -1));    // returns "f"
    var_dump(substr("abcdef", -2));    // returns "ef"
    var_dump(substr("abcdef", -3, 1)); // returns "d"

  # vice funkci viz manual .. je jich fakt kotel...




# URL funkce
  // viz vice: http://www.php.net/manual/en/ref.url.php

  # base64 encode / decode
    $str = 'This is an encoded string';

    $base = base64_encode($str);  // zakodovani
    echo $base;
    // zakodovani obrazku do base64 via:
    // http://www.php.net/manual/en/function.base64-encode.php#99842
    // http://stackoverflow.com/questions/35879/base64-encoding-image

    echo PHP_EOL; //end of line

    echo base64_decode($base); // dekodovani

    echo PHP_EOL; //end of line


  # vystaveni http (url) odkazu
    $data = array('foo'=>'bar',
                  'baz'=>'boom',
                  'cow'=>'milk',
                  'php'=>'hypertext processor');

    echo http_build_query($data) . "\n";
    echo 'www.example.com/?'.http_build_query($data, '', '&amp;') . PHP_EOL;

    // opacna funkce: parse_url




# serializace objektu
  // princip serializace je podobny jako v jazyce JAVA, searializovat lze pole, objekt...

  class MalaTrida {
    private $a = 7;
    function b() { return "ahoj"; }
  }

  $inst = new MalaTrida();
  $serial = serialize($inst); //serailizovano
  //var_dump($serial);
  $inst2 = unserialize($serial);  //deserializovano

  // instance 1 je stejna jako instance 2

  var_dump('serial: '. ($inst == $inst2),
          $inst instanceof MalaTrida,
          $inst2 instanceof MalaTrida
          );




# md5 (hash)
  // viz vice: http://php.net/manual/en/ref.hash.php  /-/  http://php.net/manual/en/function.md5.php

  //pozn: MD5 i SHA1 uz byly cracknuty...

  // sifrovani
  $kod = md5('ahoj');  // klasicke md5

  # u hash() lze vybrat z vice algoritmu
  $kod1 = hash('md5', 'ahoj');  //md5 pres hash

  var_dump($kod, $kod == $kod1);

  print_r(hash_algos());  // vypis dostupnych algoritmu

  // hash otisk lze udelat i ze souboru

  # md5_file($filename);
  # hash_file($algo, $filename);




# predavani parametrem

  // moznost predavat promenne i parametrem
    function superFunkce($var1, &$var2) {
      $var2 = $var1 * 5;
      return $var1 + 10;
    }

    var_dump(superFunkce(10, $out),
            $out);


  // moznost mit funkci s libovolnym poctem parametru
    function legie() {
      var_dump('pocet parametru: '. func_num_args(). ', argumenty: '.print_r(func_get_args(), true));
    }

    legie();  //bez parametru
    legie('a');
    legie('a', 'b');
    legie(array('a', 'b'));
    legie('a', 8, true);




# datum cas
  // viz vice info: http://php.net/manual/en/book.datetime.php
  // formatovaci znaky: http://php.net/manual/en/function.date.php

  // zase moznost proceduralniho nebo objektoveho pristupu

  # klasicke datum a cas
    $date = new DateTime('now');
    echo $date->format('Y-m-d H:i:s') . PHP_EOL;  // OOP

    echo date('Y-m-d H:i:s', strtotime('now')) . PHP_EOL;

    $date = new DateTime('+1 hour');
    echo $date->format('Y-m-d H:i:s') . PHP_EOL;  // OOP

    echo date('Y-m-d H:i:s', strtotime('+1 hour')) . PHP_EOL;

    // timestamp ciselne (casove razitko)
    echo strtotime('now') . PHP_EOL;

  // rozdil casu
    $datetime1 = new DateTime('2009-10-11');  // OOP
    $datetime2 = new DateTime('2009-10-13');
    $interval = $datetime1->diff($datetime2);
    print_r($interval);

    $datetime1 = date_create('2009-10-11');
    $datetime2 = date_create('2009-10-13');
    $interval = date_diff($datetime1, $datetime2);
    print_r($interval);

  // prime porovnavani datumu
    $dnes = new DateTime("now"); //dnes
    $zitra = new DateTime("tomorrow");  //zitra

    var_dump('==', $dnes == $zitra);
    var_dump('<', $dnes < $zitra);
    var_dump('>', $dnes > $zitra);

    echo PHP_EOL.PHP_EOL.PHP_EOL;




# regularni vyrazy
  // syntae podle Perl compatible (PCRE)
  // via: http://www.php.net/manual/en/reference.pcre.pattern.syntax.php

  # porovanavani podle regularnich vyrazu:
    $subject = "abcdef";

    var_dump(preg_match('/^def/', $subject)); //zacina 'def' ?

    var_dump(preg_match('/def/', $subject));  //konci 'def' ?
    var_dump(preg_match('/def$/', $subject));

    echo PHP_EOL;

    $subject = '12345678';
    var_dump('t1', preg_match('/[[:digit:]]{9,}/', $subject));

    $subject = '123123123';
    var_dump('t2', preg_match('/[[:digit:]]{9,}/', $subject));

    $subject = '+420123123123';
    var_dump('t3', preg_match('/[[:digit:]]{9,}/', $subject));

    $subject = '+420123123123';
    var_dump('t4', preg_match('/(\+420)?[[:digit:]]{9}/', $subject));

    // pouziti v podminkce
    if (preg_match('/[[:digit:]]{9,}/', $subject)) {
      var_dump('tohle je validni cislo');
    }



