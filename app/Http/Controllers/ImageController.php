<?php

namespace App\Http\Controllers;

use Flow\Config;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public $destination_path;
    public $config;

    public function uploadFile(Request $request)
    {
        try {

            $this->config = new Config(['tempDir' => public_path('test')]);

            $flowRequest = new \Flow\Request();

            if (\Flow\Basic::save(
                public_path($this->getImagePublicDestinationPath($request)) . '/' . $request->input('flowFilename'), $this->config, $flowRequest)
            ) {
                return response(['message' => "File Uploaded {$request->input('flowFilename')}"], 200);
            } else {
                return response([], 204);
            }
        } catch (\Exception $e) {
            throw new \Exception(sprintf("Error saving image %s", $e->getMessage()));
        }
    }

    public function getImagePublicDestinationPath(Request $request)
    {
        return ($request->input('path')) ? $request->input('path') : 'images';
    }
}