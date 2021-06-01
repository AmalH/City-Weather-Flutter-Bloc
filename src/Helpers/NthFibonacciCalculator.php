<?php


namespace App\Helpers;


class NthFibonacciCalculator implements Fibonacci
{

    public function getNumber (int $n) : int
    {

        if ($n <0){
            return 0;
        }
        if ($n == 0 || $n == 1){
            return $n;
        }

        return $this->getNumber($n-1)+$this->getNumber($n-2);

    }

}