<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateCacheSettings  extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('cache.default_cache_store', 'file'); 
        $this->migrator->add('cache.cache_lifetime', '60');             
        $this->migrator->add('cache.cache_enabled', 'true');           
        $this->migrator->add('cache.view_cache_enabled', 'true');     
        $this->migrator->add('caceh.view_cache_lifetime', '60');      
    }
};
