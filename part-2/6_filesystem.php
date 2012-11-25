<?php exit;

# funkce pro praci s filesystemem
# via: http://php.net/manual/en/book.filesystem.php



# jen zminka z formularu jde $_GET, $_POST a $_FILES
# s files se pracuje na uzovni filesystemu, via: http://php.net/manual/en/function.move-uploaded-file.php


# nacteni a ulozeni obsahu
  # nacteni
  $content = file_get_contents('./people.txt');

  # ulozeni
  $current = "John Smith\n";
  file_put_contents($file, $current);


# overeni existence
  $filename = 'filename';
  $ret = file_exists($filename);  // true pokud existuje


# datum zmeny souboru
  $filename = 'somefile.txt';
  if (file_exists($filename)) {
      echo "$filename was last modified: " . date("d.m.Y H:i:s.", filemtime($filename));
  }


# testy nad souborama
  # je slozka?
  var_dump(is_dir('a_file.txt')); // false

  # je soubor
  var_dump(is_file('a_file.txt'));

  # jde precist?
  var_dump(is_readable('a_file.txt'));

  # jde do nej zapisovat?
  var_dump(is_writable('a_file.txt'));


# prace se soubory / adresari
  # vytvoreni adresare
  mkdir("/path/to/my/dir", 0700);

  # smazani adresare (nemaze rekurzivne obsah)
  rmdir('examples');

  # prejmenovani souboru nebo slozky
  rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");

  # smazani souboru
  unlink('test.html');

  # jednoduchy vypis
  var_dump(glob("some/dir/*.txt"));

  # velikost souboru
  $filename = 'somefile.txt';
  echo $filename . ': ' . filesize($filename) . ' bytes';

  # zjisteni typu opravneni
  echo substr(sprintf('%o', fileperms('/tmp')), -4);

  # vraceni aktualniho nazvu souboru
  echo basename($_SERVER['SCRIPT_NAME']);
