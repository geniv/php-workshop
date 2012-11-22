<?php

# moznosti pripojeni do DB
# je problem s nejdnotnosti jmen funkci ktere jsou u jednotlivych db engine jine




  $user = 'stXXXXX';
  $pswd = 'TAJNEHESLO';
  $host = 'fei-sql1';

# f.e. 1) priklad proceduralni OCI8
  $c = oci_connect($user, $pswd, $host);  // pripojeni
  if (!$c) {
    var_dump(oci_error());
  }

  $stid = oci_parse($c, 'SELECT * FROM users'); //zadani dotazu
  if (!$stid) {
    var_dump(oci_error());
  }

  $r = oci_execute($stid);  //provedeni dotazu
  if (!$r) {
    var_dump(oci_error());
  }

  while ($row = oci_fetch_assoc($stid)) { //vypsani vysledku
    var_dump($row, '<hr />');
  }




# f.e. 2) priklad objektove PDO

  print_r(PDO::getAvailableDrivers());  //vypsani distupnych driveru
  // dostupne PDO drivery: http://php.net/manual/en/pdo.drivers.php

  $pdo_string = 'oci:dbname='.$host.';charset='.$charset; //vytvoreni uri pro PDO
  // vice o PDO: http://php.net/manual/en/book.pdo.php
  try {
      $dbh = new PDO($pdo_string, $user, $pswd);  //vytvoreni objektu (handleru)

      $SQLCom = "SELECT * FROM USERS";  //zadani dotazu
      $result = $dbh->query($SQLCom);
      if ($result) {
        foreach($result as $row) {  //proiterovani vysledku
          var_dump($row); //nejaky vypis/pracovani
        }
      }

  } catch (PDOException $e) {
      echo "Failed to obtain database handle: " . $e->getMessage();
      exit;
  }
