<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

 class CreateCurrencySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('currency.default_currency','ETB');  // ISO 4217 code for Ethiopian Birr
        $this->migrator->add('currency.currency_symbol', 'Br');
        $this->migrator->add('currency.decimal_places', '2');
        $this->migrator->add('currency.thousand_separator',',');
        $this->migrator->add('currency.decimal_separator', '.');
    }
}
