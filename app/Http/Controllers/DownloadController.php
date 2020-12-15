<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class DownloadController extends Controller
{
    public function processVideo($videoId)
    {
        parse_str(file_get_contents("https://youtube.com/get_video_info?video_id=" . $videoId), $info);
        $playabilityJson = json_decode($info['player_response']);
        $IsPlayable = $playabilityJson->playabilityStatus->status;
        $result = new stdClass();
        $result->videoId = $videoId;
        $result->title = $playabilityJson->videoDetails->title;

        if (!empty($info) && $info['status'] == 'ok' && strtolower($IsPlayable) == 'ok') {
            $formats = $playabilityJson->streamingData->formats;
//            print_r($formats);exit;
            $adaptiveFormats = $playabilityJson->streamingData->adaptiveFormats;
            if (isset($formats)) {
                $j = 0;
                foreach ($formats as $stream) {
                    $streamUrl = null;
                    if (isset($stream->url)) {
                        $streamUrl = $stream->url;
                    }

                    $type = explode(";", $stream->mimeType);

                    $qualityLabel = null;
                    if (!empty($stream->qualityLabel)) {
                        $qualityLabel = $stream->qualityLabel;
                    }
                    if ($qualityLabel == '720p') {
                        $result->vlink = $streamUrl;
                        $result->vtype = $type[0];
                        $result->vquality = $qualityLabel;
                    }
                    $j++;
                }
            }

            if (isset($adaptiveFormats)) {
                $i = 0;
                foreach ($adaptiveFormats as $stream) {
                    $streamUrl = null;
                    if (isset($stream->url)) {
                        $streamUrl = $stream->url;
                    }
                    $type = explode(";", $stream->mimeType);

                    $qualityLabel = null;
                    if (!empty($stream->qualityLabel)) {
                        $qualityLabel = $stream->qualityLabel;
                    }

                    if ($type[0] == 'audio/mp4') {
                        $result->alink = $streamUrl;
                        $result->atype = $type[0];
                        $result->aquality = $qualityLabel;
                    }
                    $i++;
                }
            }

            return view('download', ['result' => $result]);

        } else {
            $result->adaptiveFormats = null;
            $result->formats = null;
            return view('download', ['result' => $result]);
        }

    }

    public function videoDownload(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $fileName = $title . '.mp3';
        $path = env('SAVE_PATH');
        shell_exec('youtube-dl -x --audio-format mp3 -o "'.$path.'"music-app\public\storage\%(title)s.%(ext)s "'.$id.'"');
        $file=Storage::disk('public')->path($fileName);
        return response()->download($file)->deleteFileAfterSend(true);
    }
}
