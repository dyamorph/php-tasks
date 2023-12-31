<?php

namespace app;

class Validator
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_STRING = 'string';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';

    public array $errors = [];

    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $field => $rules) {
            $value = $this->{$field};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($field, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && (strlen($value) < $rule['min'])) {
                    $this->addError($field, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($field, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_STRING && !preg_match("~^[a-zA-Z ]*$~", $value)) {
                    $this->addError($field, self::RULE_STRING);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError($field, $rule, $params = []): void
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$field][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MAX => 'This filed must be less than {max} characters',
            self::RULE_MIN => 'This filed must be greater than {min} characters',
            self::RULE_STRING => 'This field must be a string'
        ];
    }
}
