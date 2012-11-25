<?php

# priklad tridy pracujici objektove session

  final class SessionSingleton { // final znemozni dalsi kopirovani tridy
    private static $instance = null;  //instance silgletonu
    private $session = null;

    const MAINSECT = 'session_system_section';

    private function __construct() {  // znemozneni primeho vytvoreni instance
      session_start();
      //~ $_SESSION = null;
      $_SESSION[self::MAINSECT] = null;
      $this->session = &$_SESSION[self::MAINSECT];
    }

    private function __clone() {} // zmenozneni vytvoreni instance jinym zpusobem (nemusi byt)
    private function __wakeup() {}

    public static function getInstance() {  // hlavni metoda
      if (is_null(self::$instance)) {
        self::$instance = new self;
      }
      return self::$instance;
    }

    public function __get($name) {
      return self::$instance->session[$name];
    }

    public function __set($name, $value) {
      self::$instance->session[$name] = $value;
    }

    public function __isset($name) {
      return (isset(self::$instance->session[$name]));
    }

    public function __unset($name) {
      unset(self::$instance->session[$name]);
    }
  }

  $sess = SessionSingleton::getInstance();

  $sess->moje = "ahoj";

  var_dump($sess->moje);

  var_dump(isset($sess->moje1));
  var_dump(isset($sess->moje));


  unset($sess->moje);

  var_dump($_SESSION);
