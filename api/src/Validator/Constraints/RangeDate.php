<?php
// src/Validator/Constraints/RangeDate.php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RangeDate extends Constraint
{
    public $message = 'The string {{ string }} does not follow the date constraints. The supported formats are "< 1500", "> 1500", "1300 <> 1500", "10-04-1516", "~1400", "1271".';
}
