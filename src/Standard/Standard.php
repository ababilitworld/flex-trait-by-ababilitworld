<?php

namespace Ababilitworld\FlexTraitByAbabilitworld\Standard;

use Ababilitworld\FlexTraitByAbabilitworld\Instance\Access\Access;
use Ababilitworld\FlexTraitByAbabilitworld\Instance\Instance;
USE Ababilitworld\FlexTraitByAbabilitworld\Asset\Asset;
use Ababilitworld\FlexTraitByAbabilitworld\Wordpress\Security\Sanitization\Sanitization;
use Ababilitworld\FlexTraitByAbabilitworld\Wordpress\Security\Validation\Validation;

trait Standard 
{
    use Instance, Asset, Access, Sanitization, Validation; 
}