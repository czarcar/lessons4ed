<?php
class OtherClass
{}

class MyOverlyComplicatedClass
{
    private $state1;
    private $state2;
    private $state3;
    private $state4;
    
    public function doSomething()
    {
        if(     $this->state1 == '11l111' &&
                $this->state2 == 'Edk' &&
                ($this->state3 instanceof OtherClass) &&
                $this->state4 === TRUE)
        {
            echo "I work!!!!\n";
        } else {
            echo "Something is broken\n";
        }
        
        return $this;
    }
    
    public function setState1($state) { $this->state1 = $state; }
    public function setState2($state) { $this->state2 = $state; }
    public function setState3($state) { $this->state3 = $state; }
    public function setState4($state) { $this->state4 = $state; }
}

class OverlyComplicatedClassSingleton {
    
    private $state1;
    private $state2;
    private $state3;
    private $state4;
    
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new self;
        }

        return $instance;
    }
    
    protected function __construct() {}
    
    private function __clone(){}
    
    private function __wakeup(){}
    
    public function doSomething()
    {
        if(     $this->state1 == '11l111' &&
                $this->state2 == 'Edk' &&
                ($this->state3 instanceof OtherClass) &&
                $this->state4 === TRUE)
        {
            echo "I work!!!!\n";
        } else {
            echo "Something is broken\n";
        }
        
        return $this;
    }
    
    public function setState1($state) { $this->state1 = $state; }
    public function setState2($state) { $this->state2 = $state; }
    public function setState3($state) { $this->state3 = $state; }
    public function setState4($state) { $this->state4 = $state; }
}

