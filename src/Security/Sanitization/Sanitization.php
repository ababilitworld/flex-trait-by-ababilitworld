<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Security\Sanitization;

trait Sanitization 
{
    /**
     * Sanitizer
     *
     * @param string $input The string to sanitize
     * @return mixed|null The sanitized value of the @param
     */
    public function sanitize($input) 
    {
        return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }
}

?>
