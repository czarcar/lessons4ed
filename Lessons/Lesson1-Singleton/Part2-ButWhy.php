<?php

/** 
 * Part 2 - Singletons But Why?
 * 
 * I know this is cool and all, but how does this help me?  So we've seen that we always
 * get the exact same object state and all but you're still not really impressed. Now we can
 * see how this can help us.
 */
include './includes/Part2.php';

/**
 * Step 1
 * I've included an overly complicated class called MyOverlyComplicatedClass.  It takes a very
 * precise state for it to work properly. Our problem is that it needs to work in various locations
 * of our code.  Right now it is NOT a singleton.  To get it to work properly we need to keep
 * duplicating our code just to get it to work.  Ughhh.  What if these 'states' were passwords,
 * network settings or a complex set of things that needed to be done.  It would have to be
 * duplicated everywhere and one typo messes the whole thing up.
 */

$myOverlyComplicatedClass = new MyOverlyComplicatedClass();
$myOverlyComplicatedClass->setState1('11l111');
$myOverlyComplicatedClass->setState2('Edk');
$myOverlyComplicatedClass->setState3(new OtherClass);
$myOverlyComplicatedClass->setState4(true);



function doSomething() {
    $myOverlyComplicatedClass = new MyOverlyComplicatedClass();
    $myOverlyComplicatedClass->setState1('11l111');
    $myOverlyComplicatedClass->setState2('Edk');
    $myOverlyComplicatedClass->setState3(new OtherClass);
    $myOverlyComplicatedClass->setState4(true);

    //Works
    $myOverlyComplicatedClass->doSomething();
    
    return $myOverlyComplicatedClass;
}

class doSomethingClass {
    
    public static function doSomething()
    {
        $myOverlyComplicatedClass = new MyOverlyComplicatedClass();
        $myOverlyComplicatedClass->setState1('111111');
        $myOverlyComplicatedClass->setState2('Edk');
        $myOverlyComplicatedClass->setState3(new OtherClass);
        $myOverlyComplicatedClass->setState4(true);

        //Works
        $myOverlyComplicatedClass->doSomething();
        
        return $myOverlyComplicatedClass;
    }
}

// From global context
$object1 = $myOverlyComplicatedClass->doSomething();

// From inside a function context
$object2 = doSomething();

// From inside a class context
$object3 = doSomethingClass::doSomething();

// While they may all do the same thing.  They are not the same object.
if (spl_object_hash($object1) === spl_object_hash($object2)) {
    echo "object1 and object2 are exactly the same\n";
} else {
    echo "object1 and object2 are not exactly the same\n";
}

if (spl_object_hash($object2) === spl_object_hash($object3)) {
    echo "object2 and object3 are exactly the same\n";
} else {
    echo "object2 and object3 are not exactly the same\n";
}

die("End Step 1");


/**
 * OOPS Something broke!  A parameter for the doSomethingClass is incorrect.
 * This is why we repeating code is bad for business!!!!!
 * Can you spot the error?
 * [Find the broken parameter and correct it so that everything works.]
 */
die("End Step 2");


/**
 * Step 3
 * [comment out the die() statement in step 2]
 * Just to get those 3 calls to work we need to duplicate our code 3 different times.
 * YUCK!
 * Lets turn our overly complicated class into a singleton, so we can "set it and forget it"
 */

$overlyComplicatedSingleton = OverlyComplicatedClassSingleton::getInstance();
$overlyComplicatedSingleton->setState1('11l111');
$overlyComplicatedSingleton->setState2('Edk');
$overlyComplicatedSingleton->setState3(new OtherClass);
$overlyComplicatedSingleton->setState4(true);


function insideDoSomething()
{
    $insideAFunction = OverlyComplicatedClassSingleton::getInstance();
    $insideAFunction->doSomething();
    return $insideAFunction;
}

class insideClassDoSomething
{
    public static function doSomething()
    {
        $insideAClass = OverlyComplicatedClassSingleton::getInstance();
        $insideAClass->doSomething();
        return $insideAClass;
    }
}

// From global context
$object1 = $overlyComplicatedSingleton->doSomething(); //Works

// From inside a function context
$object2 = insideDoSomething();

// From inside a class context
$object3 = insideClassDoSomething::doSomething();

// And we can prove that they are still all the same object.
if (spl_object_hash($object1) === spl_object_hash($object2)) {
    echo "object1 and object2 are exactly the same\n";
} else {
    echo "object1 and object2 are not exactly the same\n";
}

if (spl_object_hash($object2) === spl_object_hash($object3)) {
    echo "object2 and object3 are exactly the same\n";
} else {
    echo "object2 and object3 are not exactly the same\n";
}