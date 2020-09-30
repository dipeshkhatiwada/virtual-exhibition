<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ChatMessage;
use File;

class ChatMessage extends Model
{
    protected $table = 'chat_message';

    protected $fillable = ['message_from', 'message_to','message','view_status','from_delete','to_delete', 'type', 'documents'];


    public static function getDocuments($datas= NULL,$type = NULL, $id ='')
    {
    	$return_data = '';
    	$documents = json_decode($datas);
    	if (is_array($documents)) {
    		$i = 1;
    		$total = count($documents);
    		if ($total == 1) {
    			$cls = 'chat-images1';
    		} elseif ($total == 2) {
    			$cls = 'chat-images2';
    		} else{
    			$cls = 'chat-images';
    		}
    		foreach ($documents as $key => $doc) {
    			if ($type == 'image') {
    				$return_data .= '<a href="'.asset('image/'.$doc).'" title="Image" class="fancybox" data-fancybox-group="group'.$id.'">
                                    <img src="'.asset(\App\Imagetool::mycrop($doc,250,250)).'" class="'.$cls.'" alt="image">
                                </a>';
    				
    			} else{
    				$docs = explode('/', $doc);

    				$return_data .= '<a href="'.asset('image/'.$doc).'" target="_bnalk">'.end($docs).'</a>';
    			}
    			$i++;
    			
    		}
    	}
    	return $return_data;
    }

    public static function DeleteDocuments($datas='')
    {
    	$documents = json_decode($datas);
    	if (is_array($documents)) {
    		foreach ($documents as $key => $doc) {
    			if (is_file(DIR_IMAGE.$doc)) {
    				File::delete(DIR_IMAGE.$doc);
    			}
    		}
    	}
    	return 'Success';
    }

}
