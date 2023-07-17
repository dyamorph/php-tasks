<?php

namespace database\seeds;

class UserFactory
{
    private static array $names
        = array(
            "John Doe",
            "Jane Smith",
            "Michael Johnson",
            "Emily Brown",
            "William Wilson",
            "Olivia Davis",
            "Emily Seven",
            "Mike Brown"
        );

    private static array $emailDomains
        = array(
            "example.com",
            "testmail.com",
            "gmail.net",
            "mail.com"
        );

    private static array $genders
        = array(
            "male",
            "female",
        );

    private static array $statuses
        = array(
            "active",
            "inactive",
        );

    public static function generateUser()
    {
        $randomName = self::$names[array_rand(self::$names)];
        $randomEmailDomain = self::$emailDomains[array_rand(self::$emailDomains)];
        $randomGender = self::$genders[array_rand(self::$genders)];
        $randomStatus = self::$statuses[array_rand(self::$statuses)];
        $randomEmail = strtolower(str_replace(" ", ".", $randomName)) . "@" . $randomEmailDomain;

        return [$randomName, $randomEmail, $randomGender, $randomStatus];
    }
}
