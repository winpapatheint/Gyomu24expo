<?php

namespace App\Http\Traits;
use App\Models\Seminar;

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;

trait MsgTrait {
    
    public function storemsg( $taskhashid,
                              $roomnum,
                              $title = '',
                              $body,
                              $type = 'msg',
                              $attachment = '',
                              $receiver = ''
                            ) 

    {

            $data=array('taskhashid'=>$taskhashid,
                        "roomnum"=>$roomnum,
                        "title"=>$title,
                        "body"=>$body,
                        "sender"=>Auth::user()->id,
                        "receiver"=>$receiver,
                        "type"=>$type,
                        "attachment"=>$attachment,
                        "created_at"=> new \DateTime()
                       );
            DB::table('msg')->insert($data);
        
            return true;
        
        return false;

    }

     
}