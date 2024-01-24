<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PasswordConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof PasswordConstraint) {
            throw new UnexpectedTypeException($constraint, PasswordConstraint::class);
        }
        if (strlen($value) < 6) {
            $this->context->buildViolation($constraint->minLenPassword)
                ->addViolation();
        }
        if (strlen($value) > 16) {
            $this->context->buildViolation($constraint->maxLenPassword)
                ->addViolation();
        }
        if (preg_match('/\d+/', $value) < 1) {
                $this->context->buildViolation($constraint->haveNumber)
                    ->addViolation();
        }
        if (preg_match('/[A-Z]+/', $value) < 1) {
                $this->context->buildViolation($constraint->haveUppercaseLetter)
                    ->addViolation();
        }
        if (preg_match('/[a-z]+/', $value) < 1) {
                $this->context->buildViolation($constraint->haveLowercaseLetter)
                    ->addViolation();
        }
        if (preg_match('/^[a-zA-Z0-9!?]+$/', $value) < 1) {
                $this->context->buildViolation($constraint->haveInvalidSymbols)
                    ->addViolation();
        }
    }
}
