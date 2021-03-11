<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QCod\AppSettings\Setting\AppSettings;

class AdminThemeOptionController extends Controller
{
    public function index(AppSettings $appSettings)
    {
        $settings = $appSettings->loadConfig(config('app_settings', []));
        // return $settings['sections'];
        return view('backend.theme_option.index', ['settings'=>$settings['sections']]);
    }
}
