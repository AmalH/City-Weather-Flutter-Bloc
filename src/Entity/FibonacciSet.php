<?php
namespace App\Entities;


class FibonacciSet
{

    private $id;
    private $number;
    private $nthFibOfNumber;


    public function getId ()
    {
        return $this->id;
    }

    public function setId ($id)
    {
        $this->id = $id;
    }

    public function getNumber ()
    {
        return $this->number;
    }

    public function setNumber ($number)
    {
        $this->number = $number;
    }

    public function getNthFibOfNumber ()
    {
        return $this->nthFibOfNumber;
    }

    public function setNthFibOfNumber ($nthFibOfNumber)
    {
        $this->nthFibOfNumber = $nthFibOfNumber;
    }



}