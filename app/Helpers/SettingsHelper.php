<?php
namespace App\Helpers;
use App\Setting;


class SettingsHelper
{
  public static function get()
  {
    return $settings = Setting::first();
  }
}