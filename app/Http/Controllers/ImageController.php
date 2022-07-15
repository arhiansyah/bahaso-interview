<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function showImage($filename)
    {
        $exists = Storage::disk('public')->exists($filename);
        if ($exists) {

            //     //get content of image
            $content = Storage::get('public/' . $filename);
            // dd($content);

            //     //get mime type of image
            $mime = Storage::mimeType('public/' . $filename);
            //     //prepare response with image content and response code
            $response = Response::make($content, 200);

            //     //set header 
            $response->header("Content-Type", $mime);
            //     // return response
            return $response;
        } else {
            $this->getDefaultImage();
        }
    }


    protected function getDefaultImage()
    {
        $content = Storage::get('public/default/noimage.png');
        $mime = Storage::mimeType('public/default/noimage.png');
        $response = Response::make($content, 200);
        $response->header("Content-Type", $mime);
        // dd($response);
        return $response;
    }
}
