<?php

abstract class Unit
{
    /**
     * @var array
     */
    protected $units = array();

    /**
     * @abstract
     */
    abstract public function fire ();

    /**
     * @param Unit $unit
     * @return Unit
     */
    public function addUnit (Unit $unit)
    {
        if (!in_array($unit, $this->units, true)) {
            array_push($this->units, $unit);
        }
        return $this;
    }
}

class Soldier extends Unit
{
    /**
     * @return int
     */
    public function fire ()
    {
        return 5;
    }
}

class Dog extends Unit
{
    /**
     * @return int
     */
    public function fire ()
    {
        return 3;
    }
}

class Army extends Unit
{
    /**
     * @return int
     */
    public function fire ()
    {
        $return = 0;
        foreach ($this->units as $unit) {
            $return += $unit->fire();
        }
        return $return;
    }
}

// Example
$firstArmy = new Army();
$firstArmy->addUnit(new Soldier());
$firstArmy->addUnit(new Dog());
$firstArmy->addUnit(new Dog());

$secondArmy = new Army();
$secondArmy->addUnit(new Dog());
$secondArmy->addUnit(new Soldier());
$secondArmy->addUnit(new Soldier());

$secondArmy->addUnit($firstArmy);
echo $secondArmy->fire();