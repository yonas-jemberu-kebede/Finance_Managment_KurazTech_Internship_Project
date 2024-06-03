<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class EmailSettings extends Settings
{
    public ?string $smtp_host;
    public ?int $smtp_port;
    public ?string $smtp_username;
    public ?string $smtp_password;
    public ?string $encryption;
    public string $from_emailaddress="no-reply@appshut.xyz";
    public string $from_name="appshut";
    public string $mail_type="PHP Mail";

    public static function group(): string
    {
        return 'email';
    }
  
}