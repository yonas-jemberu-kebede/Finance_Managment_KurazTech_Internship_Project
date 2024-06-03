<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings\EmailSettings;
use App\Settings\GeneralSettings;
use App\Settings\CacheSettings;
use App\Http\Controllers\CurrencySettings;
use App\Settings\LogoAndFavicon;

class SettingsController extends Controller
{
    public function showSettings(GeneralSettings $settings)
    {
        return response()->json([
            'settings' => [
                'company_name' => $settings->company_name,
                'site_title' => $settings->site_title,
                'phone' => $settings->phone,
                'email' => $settings->email,
                'time_zone' => $settings->time_zone,
                'language' => $settings->language,
                'backend_direction' => $settings->backend_direction,
                'date_format' => $settings->date_format,
                'time_format' => $settings->time_format,
            ]
        ]);
    }

    // Update the settings
    public function updateSettings(Request $request, GeneralSettings $settings)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'site_title' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'time_zone' => 'required|string|max:255',
            'language' => 'nullable|string|max:255',
            'backend_direction' => 'required|string|max:255',
            'date_format' => 'required|string|max:255',
            'time_format' => 'required|string|max:255',
        ]);

        // Update each setting property individually
        $settings->company_name = $validated['company_name'];
        $settings->site_title = $validated['site_title'];
        $settings->phone = $validated['phone'];
        $settings->email = $validated['email'];
        $settings->time_zone = $validated['time_zone'];
        $settings->language = $validated['language'];
        $settings->backend_direction = $validated['backend_direction'];
        $settings->date_format = $validated['date_format'];
        $settings->time_format = $validated['time_format'];

        // Save the changes to the settings
        $settings->save();

        return response()->json([
            'status' => 'Settings updated successfully!',
            'settings' => $settings->toArray(), // Optionally return updated settings
        ]);
    }
}
