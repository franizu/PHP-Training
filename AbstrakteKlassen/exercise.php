<?php
abstract class Test{
  abstract public function printHallo();
}
class TestExtended extends Test{
  public function printHallo(){
    var_dump('Hallo!');
  }
}


$test = new TestExtended();
$test -> printHallo();

?>
