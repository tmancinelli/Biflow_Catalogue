<?php 
// src/Validator/Constraints/RangeDateValidator.php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

// Data range validator supports these types:
// >1234
// >~1234
// <1234
// <~1234
// 1234<>2345
// ~1234<>2345
// 1234<>~2345
// ~1234<>~2345
// 01-01-1234
// 01-1234
// ~1234
// 1234
// Before and after ~, <, >, <> spaces are supported.
class RangeDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof RangeDate) {
            throw new UnexpectedTypeException($constraint, RangeData::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (!preg_match('/^(>\s*~?\s*\d\d\d\d|<\s*~?\s*\d\d\d\d|(~?\s*\d\d\d\d|\d\d-\d\d-\d\d\d\d|\d\d-\d\d\d\d)\s*<>\s*(~?\s*\d\d\d\d|\d\d-\d\d-\d\d\d\d|\d\d-\d\d\d\d)|\d\d-\d\d-\d\d\d\d|\d\d-\d\d\d\d|~\s*\d\d\d\d|\d\d\d\d|)$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
