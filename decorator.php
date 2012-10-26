<?php

abstract class Place
{
    abstract public function getMoneyFactor ();
}

abstract class PlaceDecorator extends Place
{
    /**
     * @var Place
     */
    protected $place = null;

    /**
     * @param Place $place
     */
    public function __construct (Place $place)
    {
        $this->place = $place;
    }
}

class Forest extends Place
{
    /**
     * @var int
     */
    private $moneyFactor = 5;

    /**
     * @return int
     */
    public function getMoneyFactor ()
    {
        return $this->moneyFactor;
    }
}

class DiamondDecorator extends PlaceDecorator
{
    /**
     * @return int
     */
    public function getMoneyFactor ()
    {
        return $this->place->getMoneyFactor() + 2;
    }
}

class DirtyDecorator extends PlaceDecorator
{
    /**
     * @return int
     */
    public function getMoneyFactor ()
    {
        return $this->place->getMoneyFactor() - 3;
    }
}

// Example
$forest = new DirtyDecorator(new DiamondDecorator(new Forest()));
echo $forest->getMoneyFactor();