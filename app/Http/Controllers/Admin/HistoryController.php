<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use App\Helper\Helper;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// Helper::GetApi('https://www.iplocate.io/api/lookup/');
class HistoryController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function GetApi($url)
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $request = $client->get($url);
    //     $response = $request->getBody();
    //     return $response;
    //     // dd($client);
    // }

    // public function PostApi($url,$body) {
    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->request("POST", $url, ['form_params'=>$body]);
    //     $response = $client->send($response);
    //     return $response;
    // }
    // $this->GetApi('https://www.iplocate.io/api/lookup/');
}
