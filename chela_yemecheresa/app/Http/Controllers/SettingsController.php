<?php

namespace App\Http\Controllers;

use App\Settings\CurrencySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Settings\GeneralSettings;
use App\Settings\EmailSettings;
class SettingsController extends Controller
{
    public function showGeneralSettings(GeneralSettings $settings)
    {
        return response()->json([
            'General settings' => [
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
    public function updateGeneralSettings(Request $request, GeneralSettings $settings)
    {
        $request->validate([
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
        $settings->company_name = $request->company_name;
        $settings->site_title = $request->site_title;
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->time_zone = $request->time_zone;
        $settings->language = $request->language;
        $settings->backend_direction = $request->backend_direction;
        $settings->date_format = $request->date_format;
        $settings->time_format = $request->time_format;

        // Save the changes to the settings
        $settings->save();

        return response()->json([
            'status' => 'Settings updated successfully!',
            'settings' => $settings->toArray(), // Optionally return updated settings
        ]);
    }
    
    public function showEmailSettings(EmailSettings $settings){
        return response()->json([
          'Email Settings'=>[
            ' smtp_host' => $settings->smtp_host,
            ' smtp_port'=> $settings->smtp_port,
           'smtp_username' => $settings->smtp_username,
           ' encryption'=> $settings->encryption,

           ' from_name' => $settings-> from_name,
           'smtp_password' => $settings->smtp_password,
           ' mail_type' => $settings-> mail_type,
           'from_emailaddress' => $settings->from_emailaddress,
          ]
        ]);
    }

    public function updateEmailSettings(Request $request,EmailSettings $emailsettings){
        dd($request->all());

        $request->validate([

                'smtp_host' => 'nullable|string|max:255',
                'smtp_port' => 'nullable|integer|min:1|max:65535',
                'smtp_username' => 'nullable|string|max:255',
                'smtp_password' => 'nullable|string|max:255',
                'encryption' => 'nullable|string|max:255',
                'from_emailaddress' => 'required|email|max:255',
                'from_name' => 'required|string|max:255',
                'mail_type' => 'required|string|in:PHP Mail,SMTP', // Ensure mail_type is either "PHP Mail" or "SMTP"
            ]);

            
            // Update each setting property individually
            $emailsettings->smtp_host = $request->smtp_host;
            $emailsettings->smtp_port = $request->smtp_port;
            $emailsettings->smtp_username = $request->smtp_username;
            $emailsettings->smtp_password = $request->smtp_password;
            $emailsettings->encryption = $request->encryption;
            $emailsettings->from_emailaddress = $request->from_emailaddress;
            $emailsettings->from_name = $request->from_name ;
            $emailsettings->mail_type = $request->mail_type;
            
    
            $emailsettings->save();

            return response()->json([
                'status' => 'Settings updated successfully!',
                'settings' => $emailsettings->toArray(), // Optionally return updated settings
            ]);
        }

        public function showcurrencysetting(CurrencySettings $settings){
            return response()->json([
        'currency settings'=>[
            
        ]
            ]);


        }
     
        
    }

