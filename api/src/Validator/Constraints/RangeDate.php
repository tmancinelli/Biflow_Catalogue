<?php
// src/Validator/Constraints/RangeDate.php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RangeDate extends Constraint
{
    public $message = 'The string {{ string }} does not follow the date constraints. The supported formats are "< 1500", "< ~1500", "> 1500", "> ~1500", "1300 <> 1500", "~1300 <> ~1500", "10-04-1516", "04-1516", "~1400", "1271", "~1300 <> 10-04-1516", "~1300 <> 04-1345", "04-1456 <> ~1500", "03-05-1345 <> ~1234".';
}
