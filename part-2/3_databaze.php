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

    //insert
    $sql = 'insert into users (username, email) values (?, ?)';
    $state = $conn->prepare($sql);
    var_dump($state->execute(array('franta', 'franta@email.cz')));

    $tab = '<table border=1>
    <tr>
      <th>id</th>
      <th>jmeno</th>
      <th>email</th>
    </tr>
    ';

    //select
    $result = $conn->query('select * from users order by id');
    if ($result) {
      foreach($result as $row) {
        $tab .= '<tr>
        <td>'.$row['ID'].'</td>
        <td>'.$row['USERNAME'].'</td>
        <td>'.$row['EMAIL'].'</td>
        </tr>';
      }
    }

    $tab .= '
    </table>';

    echo $tab;

    //delete
    $sql = 'delete from users where username=?';
    $state = $conn->prepare($sql);
    var_dump($state->execute(array('franta')));

  } catch (PDOException $e) {
    die("Failed to obtain database handle: " . $e->getMessage());
  }


# create & drop + binding

# insert + binding

# update + binding

# delete + binding

# select + binding
