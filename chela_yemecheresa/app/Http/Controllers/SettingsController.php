<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use App\Settings\EmailSettings;
use App\Settings\CurrencySettings;
use App\Settings\LogoSettings;
use App\Settings\CacheSettings;
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
            'smtp_host' => $settings->smtp_host,
            'smtp_port'=> $settings->smtp_port,
           'smtp_username' => $settings->smtp_username,
           'encryption'=> $settings->smtp_encryption,

           'from_name' => $settings-> from_name,
           'smtp_password' => $settings->smtp_password,
           'mail_type' => $settings-> mail_type,
           'from_emailaddress' => $settings->from_email,
          ]
        ]);
    }

    public function updateEmailSettings(Request $request,EmailSettings $settings){
    

        $request->validate([

                'smtp_host' => 'required|string',
                'smtp_port' => 'required|integer',
                'smtp_username' => 'required|string',
                'smtp_password' => 'required|string',
                'encryption' => 'required|string',
                'from_emailaddress' => 'required|email',
                'from_name' => 'required|string',
                'mail_type' => 'required|string',
        // Ensure mail_type is either "PHP Mail" or "SMTP"
            ]);

            
            // Update each setting property individually
            $settings->smtp_host = $request->smtp_host;
            $settings->smtp_port = $request->smtp_port;
            $settings->smtp_username = $request->smtp_username;
            $settings->smtp_password = $request->smtp_password;
            $settings->encryption = $request->encryption;
            $settings->from_emailaddress = $request->from_emailaddress;
            $settings->from_name = $request->from_name ;
            $settings->mail_type = $request->mail_type;
            
    
            $settings->save();

            return response()->json([
                'status' => 'Settings updated successfully!',
                'settings' => $settings->toArray(), // Optionally return updated settings
            ]);
        }

        public function showcurrencysetting(CurrencySettings $settings){
            return response()->json([
        'currency settings'=>[
            'currency poistion'=>$settings->currency_position,
           'thousand separator'=> $settings->thousand_separator,
           'decimal separator'=> $settings->decimal_separator,
           'decimal places'=> $settings->decimal_places 
        ]
            ]);


        }
        public function showlogosettings(LogoSettings $settings){
            return response()->json([
              'Logo Settings'=>[
   'logo_url'=>$settings->logo_url,
   'favicon_url'=>$settings->favicon_url
              ]
            ]);
        }

        public function showcachesettings(CacheSettings $settings){
            return response()->json([
              'Logo Settings'=>[
   'view cache'=>$settings->view_cache,
   'application cache'=>$settings->application_cache
              ]
            ]);
        }

        public function updatecachesettings(CacheSettings $settings,Request $request){
    
            $request->validate([
                'view_cache' => 'required|boolean',
                'application_cache' => 'required|boolean',
            ]);

            $settings->view_cache = $request->view_cache;
            $settings->application_cache = $request->application_cache;
            $settings->save();

            return response()->json([
        'message'=>'cachesetting updated succesffuly',
        'updated cachesetting'=>$settings
     ]);
        }

        public function updatelogosettings(LogoSettings $settings,Request $request){

$request->validate([
    'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'favicon' => 'nullable|image|mimes:png|max:2048',
]);

if ($request->hasFile('logo')) {
    $logoPath = $request->file('logo')->store('logos', 'public');
    $settings->logo_url = $logoPath;
}

if ($request->hasFile('favicon')) {
    $faviconPath = $request->file('favicon')->store('favicons', 'public');
    $settings->favicon_url = $faviconPath;
}

$settings->save();

            return response()->json([
                'message'=>'Logosetting updated succesffuly',
                'updated logosetting'=>$settings
             ]);
        }
        public function updatecurrencysettings(CurrencySettings $settings,Request $request){
            
            $request->validate([
                'currency_position' => 'required|string|in:left,right',
                'thousand_separator' => 'required|string|max:1',
                'decimal_separator' => 'required|string|max:1',
                'decimal_places' => 'required|integer|min:0|max:10',
            ]);
            $settings->currency_position = $request->input('currency_position');
        $settings->thousand_separator = $request->input('thousand_separator');
        $settings->decimal_separator = $request->input('decimal_separator');
        $settings->decimal_places = $request->input('decimal_places');
        $settings->save();
            return response()->json([
                'message'=>'currencysetting updated succesffuly',
                'updated currencysetting'=>$settings
             ]);
        }
        
    }

