<?php

namespace App\Http\Traits;
use App\Models\Seminar;

use \Firebase\JWT\JWT;
use GuzzleHttp\Client;


use Illuminate\Support\Facades\DB;

trait ZoomTrait {
    

    public function adminzoomkey() {

        $matters = DB::table('matters')->orwhere('for','adminzoomkey')->get();
        $adminzoomkey = $matters[0]->value;
        
        return $adminzoomkey;
    }

    public function getZoomAccessToken($zoomkey) {

        $keyarr = json_decode($zoomkey);


        if (!empty($keyarr->keyone) AND !empty($keyarr->keytwo)) {
            $keyone = $keyarr->keyone;
            // $keyone = 'SG3X9t7YQ02QemZmlBWbMQ';
            $keytwo = $keyarr->keytwo;
            // $keytwo = 'c85G8UeIfijD5BlbP6ByWjxtBqYaMPjBsyBw';

            $key = $keytwo;
            $payload = array(
                "iss" => $keyone,
                'exp' => time() + 3600,
            );

            return JWT::encode($payload, $key);    
        }
    }


    public function createZoomMeeting($title = "Let's Learn WordPress",$starttime = "2021-01-30T20:30",$duration = 30,$zoomkey = '{"keyone":"o5xbQOVIQdeC1tTY6Em09w","keytwo":"wFGBPuJlIOuenIWTgOQZ4UihXnuTjX7VXn4d"}') 

    {
        if (empty($zoomkey)) {
            $zoomkey = $this->adminzoomkey();
        }

        // print_r($zoomkey);die;
        // $zoomkey = '{"keyone":"iI34Hbz5TYicBxOa77Y1Mg","keytwo":"WvWU62JX67kxUcH7UMmZmLrGzQ3njuhtgEWW"}';
        // $zoomkey = '{"keyone":"o5xbQOVIQdeC1tTY6Em09w","keytwo":"wFGBPuJlIOuenIWTgOQZ4UihXnuTjX7VXn4d"}';

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.zoom.us',
        ]);
        
        try {
            

                $response = $client->request('POST', '/v2/users/me/meetings', [
                    "headers" => [
                        "Authorization" => "Bearer " . $this->getZoomAccessToken($zoomkey)
                    ],
                    'json' => [
                        "topic" => $title,
                        "type" => 2,
                        "start_time" => $starttime,
                        "duration" => $duration, // 30 mins
                        // "password" => "123456"
                    ],
                ]);

                $data = json_decode($response->getBody());

                return $data;
        } catch ( \Exception $e ) {
                return false;
        }



    }

    public function updateZoomMeeting($title = "Let's Learn WordPress",
                                      $starttime = "2021-01-30T20:30",
                                      $duration = 30,
                                      $zoomkey = '',
                                      $zoomid) 

    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.zoom.us',
        ]);
     
        $response = $client->request('PATCH', '/v2/meetings/'.$zoomid, [
            "headers" => [
                "Authorization" => "Bearer " . $this->getZoomAccessToken($zoomkey),
                // 'content-type' => 'application/json',
            ],
            'json' => [
                "topic" => $title,
                "type" => 2,
                "start_time" => $starttime,
                "duration" => $duration, // 30 mins
                // "password" => "123456"
            ],
        ]);

        // print_r($response);die;    
        if ($response->getStatusCode() == '204') {
            return true;
        }
        return false;

    }

     
}