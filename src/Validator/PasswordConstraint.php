<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Attribute
 */
class PasswordConstraint extends Constraint
{
    public string $minLenPassword = 'Your password must be at least 6 characters long.';
    public string $maxLenPassword = 'Your password cannot be longer than 16 characters.';
    public string $haveNumber = 'Your password must have at least one number';
    public string $haveUppercaseLetter = 'Your password must have at least one uppercase letter';
    public string $haveLowercaseLetter = 'Your password must have at least one lowercase letter';
    public string $haveInvalidSymbols = 'You are entering invalid symbols';
}
