<?php

# databaze pod drobnohledem (PDO)
  # via vice: http://php.net/manual/en/book.pdo.php
  # priklady jsou zamerne pod PDO, protoze pracovat nad knihovnou ktera si dela co chce neni vono
  # neco o sql injection: http://php.vrana.cz/obrana-proti-sql-injection.php
  # PDO via: http://www.php.net/manual/en/book.pdo.php

  # bindovanim se da osetrit sql injekce ale ne blbe zadana data!

  $user = 'iwww';
  $pswd = 'iwww2012';
  $host = 'SQL101.upceucebny.cz/oracle10';

  try {
    // pripojeni
    $conn = new PDO('oci:dbname='.$host.';charset=UTF8', $user, $pswd);


    // insert + klasicke bindovani
    $p1 = 'franta';
    $p2 = 'franta@email.cz';
    $sql = 'insert into users (username, email) values (?, ?)';
    $state = $conn->prepare($sql);
    $state->bindParam(1, $p1);
    $state->bindParam(2, $p2, PDO::PARAM_STR, 20);
    if (!$state->execute()) {
      echo 'nepodarilo se vlozit radek';
    }
    //~ if (!$state->execute(array('franta', 'franta@email.cz'))) {
      //~ echo 'nepodarilo se vlozit radek';
    //~ }


    // update + uspornejsi bindovani
    $sql = 'update users set email=? where username=?';
    $state = $conn->prepare($sql);
    if (!$state->execute(array('franta@gmail.com', 'franta'))) {
      echo 'update se nepovedl';
    }

    $tab = '<table border=1>
    <tr>
      <th>id</th>
      <th>jmeno</th>
      <th>email</th>
    </tr>
    ';


    //select - primo query
    $result = $conn->query('select * from users order by id');
    // via: http://www.php.net/manual/en/pdo.query.php
    if ($result) {
      foreach($result as $row) {
        $tab .= '<tr>
        <td>'.$row['ID'].'</td>
        <td>'.$row['USERNAME'].'</td>
        <td>'.$row['EMAIL'].'</td>
        </tr>';
      }
    }


    // klasicky select - fetch
    $sql = 'select * from users order by id';
    $state = $conn->prepare($sql);
    $state->execute();

    while ($row = $state->fetch()) { //vyber radku po kladem volani
      $tab .= '<tr>
      <td>'.$row['ID'].'</td>
      <td>'.$row['USERNAME'].'</td>
      <td>'.$row['EMAIL'].'</td>
      </tr>';
    }


    // klasicky select - fetchAll
    $sql = 'select * from users order by id';
    $state = $conn->prepare($sql);
    $state->execute();

    $res = $state->fetchAll();  //vybere vse najednou
    foreach ($res as $row) {
      echo $row['USERNAME'].PHP_EOL;
    }


    // select s bindovanim - fetch
    $px = 'franta';
    //~ $px = 'username'; // ' or 1=1-
    $sql = 'select * from users where username=?';
    $state = $conn->prepare($sql);
    $state->execute(array($px));

    while ($row = $state->fetch()) {  //vyber po jedenom radku
      $tab .= '<tr>
      <th>'.$row['ID'].'</th>
      <th>'.$row['USERNAME'].'</th>
      <th>'.$row['EMAIL'].'</th>
      </tr>';
    }


    $tab .= '
    </table>';

    echo $tab;


    // delete s bindovanim
    $sql = 'delete from users where username=?';
    $state = $conn->prepare($sql);
    if (!$state->execute(array('franta'))) {
      echo 'nepodarilo se odmazat radek';
    }


    // bind pro oci8
    //~ $stmt = oci_parse($connOci, 'SELECT * FROM LOGIN WHERE jmeno = :login');
    //~ oci_bind_by_name($stmt, ':login', $_POST['login']);
    //~ oci_execute($stmt);

  } catch (PDOException $e) {
    die("Failed to obtain database handle: " . $e->getMessage());
  }
