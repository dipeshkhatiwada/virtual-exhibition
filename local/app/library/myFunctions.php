<?php 
namespace App\library;
use DB;
use App\library\Settings;
use App\Imagetool;
   
    class myFunctions {

        public function getDefault($value) {

        	if($value == 1)
        	{
        		$myreturn = 'Default';
        	} 
        	else 
        	{
        		$myreturn = 'None Default';
        	}
            return $myreturn;
        }

       public static function getEnableList($value)
        {
        	$datas = array();
        	$datas[]= array('value' => 0, 'title' => 'Dissable' );
        	$datas[] = array('value' => 1, 'title' => 'Enable' );
        	$myreturn = '';
        	foreach ($datas as $data) {
        		if($data['value'] == $value)
        		{
        			
        			$myreturn .= '<option selected="selected"  value="'.$data['value'].'">'.$data['title'].' </option>';
        		}
        		else 
        		{
        			$myreturn .= '<option value="'.$data['value'].'">'.$data['title'].' </option>';
        		}
        		
        	}
        	return $myreturn;
        }

        public static function setEmail()
        {
            $mail=Settings::getEmails();
              
            if($mail->protocal == 'smtp'){
              $config = array(
              'driver' => $mail->protocal,
              'host' => $mail->host_name,
              'port' => $mail->smtp_port,
              'from' => array('address' => $mail->parameter, 'name' => Settings::getSettings()->name),
              'encryption' => $mail->encription,
              'username' => $mail->username,
              'password' => $mail->password,
                );
            \Config::set('mail',$config);
            } elseif ($mail->protocal == 'mail') {
             $config = array(
              'driver' => $mail->protocal,
              
                );
            \Config::set('mail',$config);
            } elseif ($mail->protocal == 'mailgun') {
             $config = array(
              'driver' => $mail->protocal,
              
              
                );
            \Config::set('mail',$config);
            $mailgun = array('domain' => $mail->host_name,  'secret' => $mail->encription, );
            $services = array('mailgun' => $mailgun, );
            \Config::set('services', $services);
            }
            elseif ($mail->protocal == 'mandrill') {
             $config = array(
              'driver' => $mail->protocal,
              
                );
            \Config::set('mail',$config);
            $mailgun = array('secret' => $mail->encription, );
            $services = array('mandrill' => $mailgun, );
            \Config::set('services', $services);
            }
        }

        public static function getDefaultList($value)
        {
        	$datas = array();
        	$datas[]= array('value' => 0, 'title' => 'None Default' );
        	$datas[] = array('value' => 1, 'title' => 'Default' );
        	$myreturn = '';
        	foreach ($datas as $data) {
        		
        		if($data['value'] == $value)
        		{
        			
        			$myreturn .= '<option selected="selected"  value="'.$data['value'].'">'.$data['title'].' </option>';
        		}
        		else 
        		{
        			$myreturn .= '<option value="'.$data['value'].'">'.$data['title'].' </option>';
        		}
        		
        	}
        	return $myreturn;
        }


        public static function removeSpace($value)
        {
           $string = str_replace(' ', '-', $value); // Replaces all spaces with hyphens.
            return $string; // Removes special chars.
        }

        public static function getAlbumThumb($id)
        {
            $photo = DB::table('photo')->where('album_id', $id)->first();
            $sizes=Settings::getImages();

            return Imagetool::mycrop($photo->image, $sizes->thumb_width, $sizes->thumb_height);
        }

        public static function curPageURL() {
            if(isset($_SERVER['HTTPS'])){
                $pageURL = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
                }
            else{
                $pageURL = 'http';
                }
                $pageURL .='://';
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
            return $pageURL;
            }


    }

?>