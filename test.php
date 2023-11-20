<?php
interface Ishape{
    function calculate();
}
trait IshapeTrait{
    public function calculate(){
        echo "circle";
    }
}
class Asquare implements Ishape{
    function calculate(){
        echo "square";
    }
}
class Acircle implements Ishape{
    function calculate(){
        echo "circle";
    }
}
class Bcircle implements Ishape{
    use IshapeTrait;
}

$a=new Acircle;
$b=new Asquare;
$c=new Bcircle;
$a->calculate();
echo "\n";
$b->calculate();
echo "\n";
$c->calculate();




interface Example {
    // Today, you cannot specify an implementation, only a
    // signature.
    function method1(): void;
   
    // With this RFC, you can provide an implementation:
    function method2(): void {
      echo __METHOD__, "\n";
    } 
  }