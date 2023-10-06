<?php

namespace App\Http\Controllers;

use App\Classes\ImageHandler;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\UploadImgRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Response;
use Inertia\ResponseFactory;

class GalleryController extends Controller
{
    public function resize(Gallery $gallery)
    {
        (new ImageHandler())->createResized($gallery);


        dd(tmr(),);

    }

    public function upload(UploadImgRequest $request, Gallery $gallery)
    {
        $dir = "galleries/$gallery->slug/orig";
        $lastKey = +Str::beforeLast(Str::afterLast(last(Storage::files("public/$dir")), '/'), '.');

        foreach ($request->validated('photos') ?? [] as $key => $photo) {
            // increment the last filename
            $filename = str_pad($lastKey + $key + 1, 3, 0, STR_PAD_LEFT);
            $ext = Str::afterLast($photo->guessExtension(), '/');
            $photo->storePubliclyAs($dir, "$filename.$ext", ['disk' => 'public']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        $galleries = Gallery::query()->get();

        return inertia('Admin/Galleries/Index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd(tmr(), $request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): Response|ResponseFactory
    {
        return inertia('Admin/Galleries/Edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Gallery $gallery):RedirectResponse
    public function update(Gallery $gallery): RedirectResponse
    {
        dd(tmr(), $gallery, request()->all());
        $validated = $request->validated();

        $gallery->update($validated);

        return redirect(route('galleries.edit', $gallery))->withSuccess('updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
