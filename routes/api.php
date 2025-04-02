<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

$baseUrl = "http://short.est/";

Route::post('/encode', function (Request $request) use ($baseUrl) {
    $request->validate([
        'url' => 'required|url',
    ]);

    $originalUrl = $request->input('url');

    if (Cache::has("original:$originalUrl")) {
        return response()->json([
            'short_url' => Cache::get("original:$originalUrl")
        ]);
    }

    $shortCode = Str::random(6);
    $shortUrl = $baseUrl . $shortCode;

    Cache::put("short:$shortCode", $originalUrl, now()->addDays(1));
    Cache::put("original:$originalUrl", $shortUrl, now()->addDays(1));

    return response()->json([
        'short_url' => $shortUrl
    ]);
});

Route::post('/decode', function (Request $request) use ($baseUrl) {
    $request->validate([
        'short_url' => 'required|url',
    ]);

    $shortUrl = $request->input('short_url');
    $shortCode = Str::afterLast($shortUrl, '/');

    $originalUrl = Cache::get("short:$shortCode");

    if (!$originalUrl) {
        return response()->json(['error' => 'Short URL not found'], 404);
    }

    return response()->json([
        'original_url' => $originalUrl
    ]);
});
