<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

/*
|--------------------------------------------------------------------------
| Fallback to the legacy XNova
|--------------------------------------------------------------------------
|
| Before sending the response back, though, let's check if current
| request can be handled by the legacy XNova code. Hooking here
| allows us to use full power of the Laravel framework and if
| we will find no matching file, then request will continue
| its usual lifecycle and Laravel will handle it instead.
|
*/

$root = $request->root();
$url = $request->url();

$file = substr(str_replace($root, '', $url), 1);

if (!$file) {
    $file = 'index.php';
}

$path = base_path("legacy/$file");

// Assume index.php for directories
if (is_dir($path)) {
    $path .= '/index.php';
}

$fileExtension = pathinfo($path, PATHINFO_EXTENSION);

if (is_file($path) && str_contains($file, '..') === false) {
    if ($fileExtension == 'php') {
        chdir(base_path(str_contains($path, '/admin') ? 'legacy/admin' : 'legacy/'));

        require $path;
    } else {
        $fileInfo = new finfo(FILEINFO_MIME);
        $mime = $fileInfo->file($path);

        header("Content-Type: $mime");
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60 * 60 * 24 * 30) . ' GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
        header('Cache-Control: post-check=0, pre-check=0', false);
        readfile($path);
    }
} else {
    $response->send();

    $kernel->terminate($request, $response);
}
