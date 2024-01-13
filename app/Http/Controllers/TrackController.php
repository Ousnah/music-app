<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    public function index()
    {

        $tracks = Track::where('display', true)
        ->orderBy('id', 'desc')
        ->get();

        return Inertia::render("Track/Index", [
            "tracks" => $tracks,
        ]);
    }

    public function create()
    {
        return Inertia::render("Track/Create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'artist' => ['string', 'required', 'max:255'],
            'image' => ['image', 'required'],
            'music' => ['file', 'extensions:mp3,wav', 'required'],
            'display' => ['boolean', 'required'],
        ]);

        $uuid = 'trk-' . Str::uuid();

        $imageExtension = $request->image->extension();
        $musicExtension = $request->music->extension();

        $imagePath = $request->image->storeAs('tracks/images', 'img-' . $uuid . '.' . $imageExtension);
        $musicPath = $request->music->storeAs('tracks/musics', 'music-' . $uuid . '.' . $musicExtension);

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'image' => $imagePath,
            'music' => $musicPath,
            'display' => $request->display,
        ]);

        return redirect()->route('tracks.create');
    }

    public function edit(Track $track)
    {
        return Inertia::render("Track/Update", [
            'track' => $track,
        ]);
    }

    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => ['string', 'required', 'max:255'],
            'artist' => ['string', 'required', 'max:255'],
            'display' => ['boolean', 'required'],
        ]);

        $track->update([
            'title' => $request->title,
            'artist' => $request->artist,
            'display' => $request->display,
        ]);

        return redirect()->route('tracks.index');
    }

    public function destroy(Track $track)
    {
        $track->delete();

        $tracks = Track::where('display', true)
        ->orderBy('id', 'desc')
        ->get();

        return redirect()->route('tracks.index', [
            'tracks' => $tracks]
        );
    }
}
