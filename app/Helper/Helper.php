<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;

class Helper 
{
    public static function GetApi($url)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get($url);
        $response = $request->getBody()->getContents();
        return $response;
    }

    public static function PostApi($url,$body) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request("POST", $url, ['form_params'=>$body]);
        $response = $client->send($response);
        return $response;
    }
}
