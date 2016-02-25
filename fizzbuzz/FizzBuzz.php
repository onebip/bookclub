<?php

class FizzBuzz
{
    private $rules = [];

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function play($number)
    {
        $output = '';

        foreach ($this->rules as $rule) {
            $output .= $rule->output($number);
        }

        if (strlen($output)) {
            return $output;
        }
        return $number;
    }
}

class FizzBuzzPrettyString
{
    public static function output(FizzBuzz $fizzBuzz, $number)
    {
        return $fizzBuzz->play($number) . PHP_EOL;
    }
}
class MultipleKnowledge
{
    private $number;
    private $output;

    public function __construct($number, $output)
    {
        $this->number = $number;
        $this->output = $output;
    }

    public function output($input)
    {
        if ($input % $this->number == 0) {
            return $this->output;
        }
    }
}
