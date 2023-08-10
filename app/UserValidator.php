<?php

namespace app;

use app\interfaces\IValidationRules;

class UserValidator extends Validator implements IValidationRules
{
    public string $name;
    public string $email;
    public string $gender = '';
    public string $status = '';

    public function rules(): array
    {
        return [
            'name' => [
                self::RULE_REQUIRED,
                self::RULE_STRING,
                [self::RULE_MAX, 'max' => 30],
                [self::RULE_MIN, 'min' => 6]
            ],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'gender' => [self::RULE_REQUIRED, self::RULE_STRING],
            'status' => [self::RULE_REQUIRED, self::RULE_STRING]
        ];
    }
}
