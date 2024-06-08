<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Instance\Access;

trait Access 
{
    /**
     * Static Getter
     *
     * @param string $variable_name The name of the static property
     * @return mixed|null The value of the static property, or null if not found
     */
    public static function get_static($variable_name) 
    {
        if (property_exists(static::class, $variable_name)) 
        {
            return static::${$variable_name};
        }
        return null;
    }

    /**
     * Static Setter
     *
     * @param string $variable_name The name of the static property
     * @param mixed $value The value to set
     * @return void
     */
    public static function set_static($variable_name, $value) 
    {
        if (property_exists(static::class, $variable_name)) 
        {
            static::${$variable_name} = $value;
        }
    }

    /**
     * Initializes the class
     *
     * Create instance if not exist.
     *
     * @return object The class instance
     */
    public static function instance() 
    {
        static $instance = null;

        if (!$instance) 
        {
            $instance = new static();
        }

        return $instance;
    }
}

?>
