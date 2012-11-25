<?php

# priklad tridy pracujici objektove session
# via: http://php.net/manual/en/book.session.php
# via: http://php.net/manual/en/function.setcookie.php





# SESSION
  final class SessionSingleton { // final znemozni dalsi kopirovani tridy
    private static $instance = null;  //instance silgletonu
    private $session = null;

    const MAINSECT = 'session_system_section';  //pro jednotuchost sekce pro zarazeni

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

  # pokud by melo jit o propracovanejsi zpusob
  # tak by se jeste vytvarela samotna session section jako vnitrni instance

  $sess = SessionSingleton::getInstance();

  $sess->moje = "ahoj"; // set

  var_dump($sess->moje);  // get

  var_dump(isset($sess->moje1));  // isset
  var_dump(isset($sess->moje));   // isset

  unset($sess->moje); // unset

  var_dump($_SESSION);




# COOKIE
  // abstrktni (primo nevytvoritelna) trida
  abstract class Cookie {

    # nacteni cookie
    public static function get($name) {
      return (isset($_COOKIE[$name]) ? $_COOKIE[$name] : null);
    }

    # nastaveni cookie
    public static function set($name, $value, $time = 3600) {
      return setcookie($name, $value, time() + $time);
    }
  }

  Cookie::set('cislo', 23456);

  var_dump(Cookie::get('cislo'));

  var_dump(Cookie::get('cisloXX'));

  var_dump($_COOKIE);
