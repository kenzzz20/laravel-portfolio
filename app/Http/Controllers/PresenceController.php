<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PresenceController extends Controller
{
    // POST /presence  -> "n people viewing now"
    public function __invoke(Request $r)
    {
        $id = substr(preg_replace('/[^A-Za-z0-9-]/', '', (string) $r->input('id')), 0, 40);
        if ($id === '') {
            return response()->json(['count' => 1, 'avatars' => []]);
        }
        $now = time();

        $all = Cache::get('presence', []);
        $all[$id] = $now;
        $all = array_filter($all, fn ($t) => $now - $t < 60); // active sa last 60s
        Cache::put('presence', $all, 300);

        $palette = ['#f97316', '#0ea5e9', '#22c55e', '#a855f7', '#ef4444', '#eab308'];
        $avatars = collect(array_keys($all))->take(3)->map(fn ($k) => [
            'initials' => strtoupper(substr($k, 0, 2)),
            'color' => $palette[crc32($k) % count($palette)],
        ])->values();

        return response()->json(['count' => count($all), 'avatars' => $avatars]);
    }
}