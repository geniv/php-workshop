<?php

# funkce pole
// viz vice: http://php.net/manual/en/ref.array.php

  # vytvoreni pole
    # range
    $r = range(0, 12);
    print_r($r);

    # klasicky
    $a = array('a' => 2,
              'b' => 7,
              'c' => 9,
              );
    print_r($a);


  # spojovnani
    # combine
    $a = array('green', 'red', 'yellow');
    $b = array('avocado', 'apple', 'banana');
    $c = array_combine($a, $b); // klic => hodnota
    print_r($c);

    # merge
    $array1 = array("color" => "red", 2, 4);
    $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
    $result = array_merge($array1, $array2);
    print_r($result);


  # prohazovani
    # flip
    $trans = array("a" => 1, "b" => 1, "c" => 2);
    $trans = array_flip($trans);
    print_r($trans);


  #nacitani
    # klice
    $array = array(0 => 100, "color" => "red");
    print_r(array_keys($array));

    # hodnoty
    $array = array("size" => "XL", "color" => "gold");
    print_r(array_values($array));

    # nahodne
    $input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
    $rand_keys = array_rand($input);
    var_dump($input[$rand_keys]);

    echo PHP_EOL.PHP_EOL.PHP_EOL;


  # prace s polozkama
    # slice (extrahujte kousek pole)
    echo '--slice--'.PHP_EOL;
    $input = array("a", "b", "c", "d", "e");

    print_r(array_slice($input, 2));
    print_r(array_slice($input, -2, 1));
    print_r(array_slice($input, 0, 3));

    echo PHP_EOL.PHP_EOL.PHP_EOL;

    # splice (Část pole odstrani a nahradi ji s něčím jiným)
    echo '--splice--'.PHP_EOL;
    $input = array("red", "green", "blue", "yellow");
    print_r(array_splice($input, 2)); //co se odstranuje
    print_r($input);  //zbyde v poli

    echo PHP_EOL.PHP_EOL.PHP_EOL;

    $input = array("red", "green", "blue", "yellow");
    print_r(array_splice($input, 1, -1));
    print_r($input);

    echo PHP_EOL.PHP_EOL.PHP_EOL;


  # overovani polozek
    # key exist
    $search_array = array('first' => 1, 'second' => 4);
    var_dump('keys', array_key_exists('first', $search_array));

    # value exist
    $os = array("Mac", "NT", "Irix", "Linux");
    var_dump('values', in_array("Irix", $os));


  # soucet polozek
    $a = array(2, 4, 6, 8);
    var_dump('suma: '.array_sum($a));


  # razeni
    # podle hodnot
    $fruits = array("lemon", "orange", "banana", "apple");
    sort($fruits);  // a-z
    print_r($fruits);

    rsort($fruits); // z-a
    print_r($fruits);

    #podle klicu
    $fruits = array("d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple");
    ksort($fruits); // a-z
    print_r($fruits);

    krsort($fruits); // z-a
    print_r($fruits);


  # pocitani hodnot
    $a = array();
    $a[0] = 1;
    $a[1] = 3;
    $a[2] = 5;
    var_dump('pocet: '.count($a));


# multidimenzionalni pole
  # jednoduchy priklad
  $food = array('fruits' => array('orange',
                                  'banana',
                                  'apple'),

                'veggie' => array('carrot',
                                  'collard',
                                  'pea'),
                );
    print_r($food);
