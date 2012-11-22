<?php exit;

# mozne syntaxe zapisu, vsechny jsou funkcni




# f.e. 1) ne prilis prehledny
<?php
  if($true)
     echo "true";
  else
      echo "false";
?>




# f.e. 2) divocina
<?php
  if($true):
      echo "true";
  else
      echo "false";
  endif;
?>




# f.e. 3) divocina ale to je jak destny prales :)
<?php

  if ($true) {
      ?>
      <p>The value of $true is true. Toto je HTML</p>
      <?php
  } else {
      ?>
      <p>The value of $true is false. Toto je HTML</p>
      <?php
  }
?>




# f.e. 4) prilis nedoporucuji zhorsuje prehled v kodu
<p>This is going to be ignored by PHP and displayed by the browser.</p>
<?php
    echo 'While this is going to be parsed.';
?>
<p>This will also be ignored by PHP and displayed by the browser.</p>




# f.e. 5) viz to same jako 4) ale s podminkou
<?php if ($expression == true): ?>
  This will show if the expression is true.
<?php else: ?>
  Otherwise this will show.
<?php endif; ?>




# f.e. 6) viz to same jako 4) & 5)  a tak to muze skoncit
<html><body>
<p<?php if ($highlight): ?> class="highlight"<?php endif;?>>This is a paragraph.</p>
</body></html>




# f.e. 7) jedno z lepsich reseni
<?php
  if ($true_or_false) {
      echo "<p>The value of {$true_or_false['ddf']} is true.</p>";
  } else {
      echo '<p>The value of '.$true_or_false.' is false.</p>';
  }
?>




# f.e. 8) dalsi z lepsich reseni (pouze jedno echo); osobne preferuji toto
<?php
  $text = '';

  if ($true_or_false) {
      $text = '<p>The value of $true_or_false is true.</p>';
  } else {
      $text = '<p>The value of $true_or_false is false.</p>';
  }

  echo $text;
?>




# f.e. 9) podminky jdou zapsat i na min radku, na ukor horsi citelnosti
<?php
  echo ($true_or_false ? 'true' : 'false');
?>

