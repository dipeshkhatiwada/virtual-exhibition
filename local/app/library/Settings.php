<?php namespace App\library;
use App\Setting;
 use App\Imagetool;

    class Settings {



     public static function getSettings()
     {
        return Setting::first();
     }



     public static function getImages()
     {
        $setting = Setting::first();
        return \App\SettingImage::where('setting_id', $setting->id)->first();
     }

     public static function getEmails(){
        $setting = Setting::first();
        return \App\SettingEmail::where('setting_id', $setting->id)->first();
     }
     public static function getSocials()
     {
        $setting = Setting::first();
        return \App\SettingSocial::where('setting_id', $setting->id)->first();
     }

      public static function getIcon()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->icon)) {
          $icon = Imagetool::mycrop($image->icon, 16,16);
        } else {
          $icon = '';
        }
        return $icon;
     }

      public static function getLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->logo)) {
          $logo = asset('image/'.$image->logo);
        } else {
          $logo = '';
        }
        return $logo;
     }

     public static function getJobLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->job)) {
          $job = asset('image/'.$image->job);
        } else {
          $job = '';
        }
        return $job;
     }
     public static function getTenderLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->tender)) {
          $tender = asset('image/'.$image->tender);
        } else {
          $tender = '';
        }
        return $tender;
     }
     public static function getTrainingLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->training)) {
          $training = asset('image/'.$image->training);
        } else {
          $training = '';
        }
        return $training;
     }
     public static function getTestLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->test)) {
          $test = asset('image/'.$image->test);
        } else {
          $test = '';
        }
        return $test;
     }
     public static function getEventLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->event)) {
          $event = asset('image/'.$image->event);
        } else {
          $event = '';
        }
        return $event;
     }
      public static function getProjectLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->project)) {
          $project = asset('image/'.$image->project);
        } else {
          $project = '';
        }
        return $project;
     }

      public static function getWomenLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->women)) {
          $women = asset('image/'.$image->women);
        } else {
          $women = '';
        }
        return $women;
     }

      public static function getAbleLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->able)) {
          $able = asset('image/'.$image->able);
        } else {
          $able = '';
        }
        return $able;
     }

      public static function getRetairedLogo()
     {
        $setting = Setting::first();
        $image = \App\SettingImage::where('setting_id', $setting->id)->first();
        if (is_file(DIR_IMAGE . $image->retaired)) {
          $retaired = asset('image/'.$image->retaired);
        } else {
          $retaired = '';
        }
        return $retaired;
     }
     public static function getLimitedWords($text,$startword,$numberOfWords)
                {
                if($text != null)
                    {
                        $text = strip_tags(html_entity_decode(str_replace("&nbsp;","",$text)));
                    $textArray = explode(" ", $text);
                    if(count($textArray) > $numberOfWords)
                        {
                        return implode(" ",array_slice($textArray, $startword, $numberOfWords)).'...';
                        }
                    return strip_tags(html_entity_decode(str_replace("&nbsp;","",$text)));
                    }
                return "";
                }
     public static function getLimitedCharacter($text,$startword,$numberOfWords)
                {
                if($text != null)
                    {
                        $text = strip_tags(str_replace("&nbsp;","",$text));


                    return substr($text,$startword,$numberOfWords).'...';
                    }
                return "";
                }



    }

?>
