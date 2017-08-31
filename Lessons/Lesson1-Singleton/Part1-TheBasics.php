<?php
/**
 * NOTE:  cd to Lessons Folder.  to run this execute from command line (w/o quotes)
 * "php Lesson1-Singleton/Part1-TheBasics.php"
 * 
 * 
 * Part 1:  Singletons the basics
 * 
 *   Singletons are one way of dealing with services.  Put simply, a Service is any PHP object
 * that performs some sort of "global" task.  Examples include things like a logger, or a mailer
 * task.  Singletons are ways of creating an object with state ONCE and then being able to access
 * them in any context with it's state intact.
 * 
 * Singletons follow a very strict set of rules called the "Singleton Pattern". There are minor
 * variations between the different languages but essentially the same.
 *      - Singletons are created using the #getInstance method
 *      - Singletons are "final" so that they can't be extended.
 *      - Singletons have their constructor set protected or private.
 *      - Singletons are not permitted to be "saved" or "cloned".
 * 
 * So, lets build our first singleton class and see how it works.
 */
class MyFirstSingleton {
    
    private $state = 'instantiated';
    
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
        echo "Success!  You have just {$this->state} your first singleton\n";
    }
    
    public function changeState($someValue)
    {
        $this->state = $someValue;
    }
}

/**
 *  Step 1:
 * [Run this example]
 */
$singleton = new MyFirstSingleton();


/**
 * Step 2:
 * [Comment out $singleton = new MyFirstSingleton(); in step 1]
 * Notice how we fail?  Like I said the constructor is protected meaning we can't use it.
 * [Re-Run]
 */
$singleton = MyFirstSingleton::getInstance();
$singleton->doSomething();
die();



/**
 * Step 3:
 * [Comment out die() in step 2]
 * Excellent!  Just hold your excitement down for a second though.  What exactly did we do?
 * We created a singleton and had it print out it's state.  Even if we call #getInstance again
 * we will note that even the states of the object is the same and has not been reset like when
 * creating standard objects.
 * [Re-Run]
 */
$singleton->changeState("modified");
$singleton->doSomething();

$notAnotherSingleton = MyFirstSingleton::getInstance();
$notAnotherSingleton->doSomething();  // returns "modified" rather than "instantiated"
die();


/**
 * Step 4:
 * [Comment out die() in step 3]
 * 
 * It's more than just the same state.  Here is proof that they are actually the same object.
 * State changes will always take affect.
 */
var_dump(spl_object_hash($singleton) === spl_object_hash($notAnotherSingleton));

$notAnotherSingleton->changeState('verified'); // Changing the second calling of it
$singleton->doSomething(); // Affected the first calling.
die();

// Lets move on to Part 2