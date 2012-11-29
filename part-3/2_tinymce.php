<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

  // dokumentace: http://www.tinymce.com/wiki.php/Installation

  // Default skin
  tinyMCE.init({
    // General options
    mode : "textareas",
    //~ theme : "simple",
    theme : "advanced",
    elements : "elm1",
    //~ skin : "o2k7",
  });
</script>
<!--
 id="elm1" / class="elm1"
-->
<form method="post">
  <textarea class="elm1" name="suprtext" rows=25 cols=80>
  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod
  tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua.
  At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
  no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet,
  consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore
  magna aliquyam erat, sed diamvoluptua. At vero eos et accusam et justo duo dolores et ea rebum.
   accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata
   sanctus est Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consete
   </textarea>
   <input type="submit" name="save" value="Submit" />
</form>

<?php

  if (!empty($_POST)) {
    var_dump($_POST);
  }

?>
