<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchYT(Request $request)
    {
        if ($request->input('search')) {
            $keyword = $request->input('search');
        } elseif (array_key_first($request->input()) !== '_token') {
            $keyword = array_key_first($request->input());
            $keyword = str_replace("_", "+", trim($keyword));
        } else {
            $keyword = 'arab music';
        }
        $keyword = str_replace(" ", "+", trim($keyword));
        try {
            $apikey = env('GOOGLE_API_KEY');
//            dd($apikey);
            $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&q=' . $keyword . '&maxResults=' . 10 . '&key=' . $apikey;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($response);
            $value = json_decode(json_encode($data), true);

        } catch (Exception $e) {
            echo $e;
        }

//        dd($value);

        $video = array();
        for ($i = 0; $i < 10;) {
            if (isset($value['items'][$i]['id']['videoId'])) {
                $videoId = $value['items'][$i]['id']['videoId'];
                $title = $value['items'][$i]['snippet']['title'];
                $description = $value['items'][$i]['snippet']['description'];
                $thumbnails = $value['items'][$i]['snippet']['thumbnails']['default']['url'];
                $video[] = array('videoId' => $videoId, 'title' => $title, 'description' => $description, 'thumbnails' => $thumbnails);
                $i++;
            } else {
                $i--;
            }
        }

        return view('search', ['data' => $video]);
    }
}
