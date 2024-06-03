<?php
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateEmailSettingsTable extends SettingsMigration
{
    public function up(): void
    {

        $this->migrator->add('email.smtp_host', null);
        $this->migrator->add('email.smtp_port', null);
        $this->migrator->add('email.smtp_username', null);
        $this->migrator->add('email.smtp_password', null);
        $this->migrator->add('email.encryption', null);
        $this->migrator->add('email.from_emailaddress', 'no-reply@appshut.xyz');
        $this->migrator->add('email.from_name', 'appshut');
        $this->migrator->add('email.mail_type', 'PHP Mail');

        

      
    }


}
