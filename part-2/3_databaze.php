<?php

# databaze pod drobnohledem (PDO)
  # via vice: http://php.net/manual/en/book.pdo.php
  # priklady jsou zamerne pod PDO, protoze pracovat nad knihovnou ktera si dela co chce neni vono

  $user = 'iwww';
  $pswd = 'iwww2012';
  $host = 'SQL101.upceucebny.cz/oracle10';

  try {
    //pripojeni
    $conn = new PDO('oci:dbname='.$host.';charset=UTF8', $user, $pswd);
    var_dump($conn);

    //
  } catch (PDOException $e) {
    die("Failed to obtain database handle: " . $e->getMessage())

  }


# create & drop + binding

# insert + binding

# update + binding

# delete + binding

# select + binding
