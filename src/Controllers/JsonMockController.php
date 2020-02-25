<?php

namespace Lib\JsonMock\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JsonMockController extends Controller {


    public function save(Request $request) {
        $directory     = base_path('resources/'.$request->path);
        $data          = json_encode($request->data);
        $path          = explode("/",$request->path);
        $end           = end($path);
        $slug          = true;
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $filepath      = $directory.'/'.$end.'.json';
        file_put_contents($filepath, stripslashes($data));     
        $method        = strtolower($request->method);
         $api         = "\n".'$router->'.$method.'("jsonmock/'.$request->path.'","JsonMockController@get");';
        $routes = app()->router->getRoutes();
        $current_url = '/jsonmock/'.$request->path;
        foreach ($routes as $route) {
            if($route['uri'] == $current_url) {
                $slug = false;
            }
        }
        if($slug == true) {
            file_put_contents(dirname(__DIR__, 1).'/routes.php', $api, FILE_APPEND);   
        }
        return response()->json(['message' => 'File Saved Successfully']);
    }

    public function get(Request $request) {
        $url_path          = str_replace("jsonmock","",strstr($request->fullUrl(), 'jsonmock'));
        $path          = explode("/",$url_path);
        $end           = end($path);

        $filepath      = base_path('resources/'.$url_path.'/'.$end.'.json');
        if (file_exists($filepath)) {
            return file_get_contents($filepath, true);

        } else {
            return response()->json(['message' => 'No File Saved in This Folder']);

        }
    }
}