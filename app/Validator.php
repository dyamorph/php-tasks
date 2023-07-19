<?php

namespace app;

class Validator
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_STRING = 'string';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';

    public function rules()
    {
        return [];
    }

    public function validate()
    {
    }
}