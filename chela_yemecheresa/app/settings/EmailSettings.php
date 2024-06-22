<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{
    public string $mail_type;
    public string $from_email;
    public string $from_name;
    public ?string $smtp_host;
    public ?int $smtp_port;
    public ?string $smtp_username;
    public ?string $smtp_password;
    public ?string $smtp_encryption;


    public static function group(): string
    {
        return 'email';
    }
}