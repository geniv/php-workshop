<?php

# zapisy objektu a OOP




# f.e. 1) priklad jednoducha trida
  class SimpleClass {

    const MIN_VALUE = 0.54;  //konstanta

    public $var = 'a default value';  //atribut

    public function displayVar() {  //instancni metoda co primo tiskne
        echo $this->var;
    }

    public function getVar() {  //instancni metoda s navratovou hodnotou
        return $this->var;
    }

    public static function getConst() { //staticka metoda s navratem
        return self::MIN_VALUE;
    }
  }

  $sc = new SimpleClass();
  $sc = new SimpleClass;  # nebo

  # instancni:
  $sc->displayVar();                  echo PHP_EOL;

  echo $sc->getVar();                 echo PHP_EOL;


  # staticke:
  echo SimpleClass::getConst();       echo PHP_EOL;

  echo $sc::getConst();               echo PHP_EOL;




# f.e. 2) priklad slozitejsi tridy (tzn magicke metody)
  class NotSimpleClass1 {
    private $pole = null;

    function __construct($pole) { //konstruktor
        $this->pole = $pole;
        var_dump('volano: __construct');
    }

    function __toString() { //pri konvertovani na string
      var_dump('volano: __toString');
      return print_r($this->pole, true);
    }

    function __destruct() { //desktruktor
        $this->pole = null;
        var_dump('volano: __destruct');
    }

    function __call($name, $arguments) {  //instancni pretezovani
      var_dump('volano: __call', $name, $arguments);
    }

    static function __callStatic($name, $arguments) {  //staticke pretezovani
      var_dump('volano: __callStatic', $name, $arguments);
    }

    function __get($name) { //nacitani promenne
        var_dump('volano: __get');
        return $this->pole[$name];
    }

    function __set($name, $value) { //nastavovani promenne
      $this->pole[$name] = $value;
      var_dump('volano: __set');
    }

    function __isset($name) { //testovani existence promenne
      var_dump('volano: __isset');
        return isset($this->pole[$name]);
    }

    function __unset($name) { //zruseni promenne
        unset($this->pole[$name]);
        var_dump('volano: __unset');
    }

    function __clone() {  //pri klonovani
      var_dump('volano: __clone');
    }
  }

  $pole = array('a' => 'b', 'c' => 5, 'd' => true, 'e' => 3.14);

  $nsc = new NotSimpleClass1($pole);

  $nsc->mojeMetoda('ahoj instance');
  $nsc->mojeMetoda('prvni instance', 'druha');

  $nsc::mojeMetoda('ahoj statika');

  var_dump($nsc);

  var_dump($nsc->a);

  $nsc->c += 10;
  var_dump($nsc->c);

  var_dump(isset($nsc->c));

  unset($nsc->e);

  var_dump($nsc);

  $nscX = clone $nsc;

  $nsc = null;
  $nscX = null;




# f.e. 3) priklad autloading

  # 3.1) klasicky autoloading
  function __autoload($class_name) {
      include ''.$class_name . '.php';
  }

  $tr = new trida_4_1;
  $tr = null;




  # 3.2) SPL autoaloading, pokud nevyhovuje klasicky __autoload
  function my_autoloader($class_name) {
      include $class_name . '.php';
  }
  spl_autoload_register('my_autoloader');

  $tr = new trida_4_1('spl');
  $tr = null;




# f.e. 4) priklad slozitejsi tridy (dedicnost, implementace)

  //definovane rozhranni
  interface IRozhranni {
    function mojeFunkce();
  }

  class Dedecek {
    // pra-pra-trida
  }

  class Rodic extends Dedecek {
    // pra-trida
  }

  class MojeTrida extends Rodic implements IRozhranni {
    // aktualni trida
    function mojeFunkce() {}
  }

  $mt = new MojeTrida;
  var_dump($mt);

  //existuje jeste promenne: self & parent




# f.e. 5) priklad slozitejsi tridy (float interface)

  // trida s plavoucim rozhrannim
  class FloatClass {

    private $elems = array();

    function addText($name, $label, $value = null) {  // text prvek
      $this->elems[$name] = array('type' => 'text', 'label' => $label, 'value' => $value);
      return $this;
    }

    function addPassword($name, $label, $value = null) {  // password prvek
      $this->elems[$name] = array('type' => 'password', 'label' => $label, 'value' => $value);
      return $this;
    }

    function addTextarea($name, $label, $value = null) {  // texarea prvek
      $this->elems[$name] = array('type' => 'textarea', 'label' => $label, 'value' => $value);
      return $this;
    }

    function addSubmit($name, $value = null) {  // submit prvek
      $this->elems[$name] = array('type' => 'submit', 'value' => $value);
      return $this;
    }

    function __toString() { // prevod do textu
      $result = "<form action='' method='post'>\n";

      foreach ($this->elems as $key => $value) {
        switch ($value['type']) {
          case 'text':
          case 'password':
          case 'submit':
            $val = (!empty($value['value']) ? " value='{$value['value']}'" : ''); //vkladani value

            if (!empty($value['label'])) {  // vkladani labelu
              $result .= "<label>{$value['label']}</label>";
            }

            $result .= "<input type='{$value['type']}' name='{$key}'{$val} />\n";
          break;

          case 'textarea':  // osetreni texarea
            $result .= "<texarea name='{$key}'>".(!empty($value['value']) ? $value['value'] : '')."</texarea>\n";
          break;
        }
      }

      $result .= "</form>";

      return $result;
    }
  }

  $form = new FloatClass;
  $form->addText('login', 'Zadej login')
      ->addPassword('heslo', 'Zadej heslo')
      ->addPassword('heslo1', 'opakujte heslo')
      ->addSubmit('tlacitko', 'prihlasit se')
      ;

  echo $form;


