<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('email.mail_type', 'SMTP');
        $this->migrator->add('email.from_email', 'no-reply@appbusket.com');
        $this->migrator->add('email.from_name', 'appbusket');
        $this->migrator->add('email.smtp_host', null);
        $this->migrator->add('email.smtp_port', null);
        $this->migrator->add('email.smtp_username', null);
        $this->migrator->add('email.smtp_password', null);
        $this->migrator->add('email.smtp_encryption', 'SSL');
    }
};
