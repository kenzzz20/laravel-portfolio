<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('portfolio:export', function () {
    $distPath = base_path('dist');
    File::deleteDirectory($distPath);
    File::ensureDirectoryExists($distPath);

    // Kopyahin ang compiled Vite assets (CSS/JS/Fonts)
    if (File::exists(public_path('build'))) {
        File::copyDirectory(public_path('build'), $distPath . '/build');
    }

    // Kopyahin ang iba pang folders sa public/ (gaya ng images, assets, etc.)
    foreach (File::directories(public_path()) as $dir) {
        $dirName = basename($dir);
        if (!in_array($dirName, ['build', 'storage'])) {
            File::copyDirectory($dir, $distPath . '/' . $dirName);
        }
    }

    // Kopyahin ang loose files sa public/ (gaya ng favicon.ico, CV pdf, etc.)
    foreach (File::files(public_path()) as $file) {
        if (!in_array($file->getFilename(), ['index.php', '.htaccess', 'robots.txt'])) {
            File::copy($file->getPathname(), $distPath . '/' . $file->getFilename());
        }
    }

    // I-render lahat ng GET routes bilang static HTML
    foreach (Route::getRoutes() as $route) {
        if (!in_array('GET', $route->methods())) {
            continue;
        }

        $uri = $route->uri();
        if (str_starts_with($uri, '_') || str_starts_with($uri, 'api') || str_contains($uri, '{')) {
            continue;
        }

        $request = Request::create('/' . ltrim($uri, '/'), 'GET');
        $response = app()->handle($request);

        if ($response->getStatusCode() === 200) {
            $html = $response->getContent();
            $prefix = $uri === '/' ? '.' : str_repeat('/..', substr_count(trim($uri, '/'), '/') + 1);
            $prefix = ltrim($prefix, '/');

            // Gawing relative paths ang asset links para gumana sa GitHub Pages subfolder
            $html = str_replace(url('/'), $prefix, $html);
            $html = str_replace('href="/', 'href="' . $prefix . '/', $html);
            $html = str_replace('src="/', 'src="' . $prefix . '/', $html);

            $filePath = $uri === '/'
                ? $distPath . '/index.html'
                : $distPath . '/' . trim($uri, '/') . '/index.html';

            File::ensureDirectoryExists(dirname($filePath));
            File::put($filePath, $html);
            $this->info("Exported: {$filePath}");
        }
    }

    $this->info('Done! Ready na ang dist/ folder para sa GitHub Pages.');
})->purpose('Export portfolio routes as static HTML for GitHub Pages');