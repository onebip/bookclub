<?php

class FizzBuzz
{
    private $rules = [];
    private $validators = [];

    public function __construct(array $rules, array $validators)
    {
        $this->rules = $rules;
        $this->validators = $validators;
    }

    public function play($input)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($input)) {
                throw new \InvalidArgumentException(
                    $input . ' is not a valid number'
                );
            }
        }

        $output = '';

        foreach ($this->rules as $rule) {
            $output .= $rule->output($input);
        }

        if (strlen($output)) {
            return $output;
        }

        return $input;
    }
}

class ConsoleSingleLine 
{
    public static function output($string)
    {
        return $string . PHP_EOL;
    }
}
class Rule
{
    private $factor;
    private $output;

    private function __construct($factor, $output)
    {
        $this->factor = $factor;
        $this->output = $output;
    }

    public static function fromFactorAndOutput($factor, $output) 
    {
        return new self($factor, $output);
    }

    public function output($input)
    {
        if ($this->isFactorOf($input)) {
            return $this->output;
        }

        return '';
    }

    private function isFactorOf($input)
    {
        if ($input % $this->factor === 0) {
            return true;
        }

        return false;
    }
}

interface BaseValidator
{
    public function isValid($input);
}
class PositiveIntegerValidator implements BaseValidator
{
    public function isValid($input)
    {
        if ((is_int($input) || ctype_digit($input)) && (int)$input>= 0) { 
            return true;
        }

        return false;
    } 
}
