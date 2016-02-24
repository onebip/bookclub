<?php

class FizzBuzz
{
    private $rules = [];

    public function __construct()
    {
        $this->rules[] = new MultipleOfThree();
        $this->rules[] = new MultipleOfFive();
    }

    public function check($number)
    {
        $output = '';
        foreach ($this->rules as $rule) {
            $output .= $rule->output($number);
        }

        if (strlen($output)) {
            return $output . PHP_EOL;
        }
        return $number . PHP_EOL;
    }
}

abstract class Multiple
{
    abstract public function output($number);
}

class MultipleOfThree extends Multiple
{
    public function output($number)
    {
        if ($number % 3 === 0) {
            return 'Fizz';
        }
    }
}
class MultipleOfFive extends Multiple
{
    public function output($number)
    {
        if ($number % 5 === 0) {
            return 'Buzz';
        }
    }
}
class MultipleOfThreeAndFive extends Multiple
{
    public function output($number)
    {
        if ($number % 3 === 0 && $number % 5 === 0) {
            return 'FizzBuzz';
        }
    }
}
