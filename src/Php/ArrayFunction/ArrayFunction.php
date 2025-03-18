<?php
namespace Ababilitworld\FlexTraitByAbabilitworld\Php\ArrayFunction;

trait ArrayFunction
{ 
    public function matchPattern(array $array, array $pattern): bool 
    {
        foreach ($pattern as $key => $value) 
        {
            if (!array_key_exists($key, $array)) 
            {
                return false; // Missing key
            }

            if (is_array($value)) 
            {
                if (!is_array($array[$key]) || !self::matchPattern($array[$key], $value)) 
                {
                    return false; // Nested array structure mismatch
                }
            }
        }

        return true;
    }
}