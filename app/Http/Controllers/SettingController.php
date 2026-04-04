<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //load setting page when users open \settings
    public function edit()
    {
        //get settings from  DB, only first row 
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'factory_name' => 'Smart Factory ERP',
                'currency' => 'USD',
                'timezone' => 'Asia/Beirut',
                'late_after_minutes' => 15,
            ]);
        }
    //send data to blade
        return view('admin.settings.edit', compact('setting'));
    }
    //Runs when user clicks Save Settings
    public function update(Request $request)
    {
        //check user input
        $request->validate([
            'factory_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',

            'currency' => 'required|string|max:20',
            'timezone' => 'required|string|max:100',

            'shift_start' => 'nullable',
            'shift_end' => 'nullable',
            'late_after_minutes' => 'required|integer|min:0',
        ]);

        $setting = Setting::first(); //Get existing settings
          //If not exist → create object
        if (!$setting) {
            $setting = new Setting();
        }

        $setting->updateOrCreate(
            ['setting_id' => $setting->setting_id ?? null],
            [
                'factory_name' => $request->factory_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'currency' => $request->currency,
                'timezone' => $request->timezone,
                'shift_start' => $request->shift_start,
                'shift_end' => $request->shift_end,
                'late_after_minutes' => $request->late_after_minutes,
            ]
        );

        return redirect()->route('settings.edit')
            ->with('success', 'Settings updated successfully.');
    }
}