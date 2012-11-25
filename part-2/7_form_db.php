<?php

# kombinace formulare a databaze (PDO)


  $user = 'iwww';
  $pswd = 'iwww2012';
  $host = 'SQL101.upceucebny.cz/oracle10';

echo '<a href="?akce=add&id=0">vlozit novy</a>';

  try {
    // pripojeni
    $conn = new PDO('oci:dbname='.$host.';charset=UTF8', $user, $pswd);

    $tab = '<table border=1>
    <tr>
      <th>id</th>
      <th>jmeno</th>
      <th>email</th>
      <th>akce</th>
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
        <td>
          <a href="?akce=edit&id='.$row['ID'].'">editorvat</a>
          <a href="?akce=del&id='.$row['ID'].'" onclick="return confirm(\'Opravdu se ma smazat: '.$row['USERNAME'].' ?\');">smazat</a>
        </td>
        </tr>';
      }
    }

    $tab .= '
    </table>';

    echo $tab;



    if (!empty($_GET) && isset($_GET['akce']) && isset($_GET['id'])) {
      switch ($_GET['akce']) {
        case 'add':
          # vkladani
          echo '
          <form method="post">
            <input name="username" type="text" required placeholder="sem prijde jmeno" />
            <input name="email" type="email" placeholder="sem prijde email" />
            <input name="tlacitko" type="submit" value="pridat" />
          </form>';

            if (!empty($_POST)) {
              if (!empty($_POST['username']) && !empty($_POST['email'])) {

                $sql = 'insert into users (username, email) values (?, ?)';
                $state = $conn->prepare($sql);
                $state->bindParam(1, $_POST['username']);
                $state->bindParam(2, $_POST['email']);
                if ($state->execute()) {
                  header('location: '.basename($_SERVER['SCRIPT_NAME']));
                } else {
                  echo 'neco se pokazilo...';
                }
              }
            }
        break;

        case 'edit':
          $state = $conn->prepare('select * from users where id=?');
          if ($state->execute(array($_GET['id']))) {
            $row = $state->fetch();

            echo '
            <form method="post">
              <input name="username" type="text" required placeholder="sem prijde jmeno" value="'.$row['USERNAME'].'" />
              <input name="email" type="email" placeholder="sem prijde email" value="'.$row['EMAIL'].'" />
              <input name="tlacitko" type="submit" value="upravit" />
            </form>';

            if (!empty($_POST)) {
              if (!empty($_POST['username']) && !empty($_POST['email'])) {
                $sql = 'update users set username=?, email=? where id=?';
                $state = $conn->prepare($sql);
                if ($state->execute(array($_POST['username'], $_POST['email'], $_GET['id']))) {
                  header('location: '.basename($_SERVER['SCRIPT_NAME']));
                } else {
                  echo 'neco se pokazilo...';
                }
              }
            }
          }

        break;

        case 'del':
          $sql = 'delete from users where id=?';
          $state = $conn->prepare($sql);
          if ($state->execute(array($_GET['id']))) {
            header('location: '.basename($_SERVER['SCRIPT_NAME']));
          } else {
            echo 'neco se pokazilo...';
          }
        break;
      }
    }



  } catch (PDOException $e) {
    die("Failed to obtain database handle: " . $e->getMessage());
  }
