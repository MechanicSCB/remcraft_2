<?php

namespace App\Http\Controllers;

use App\Classes\ImageHandler;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\UploadImgRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Response;
use Inertia\ResponseFactory;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        $galleries = Gallery::query()->latest('id')->get();

        return inertia('Admin/Galleries/Index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Galleries/CreateEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        $validated = $request->validated();

        $gallery = Gallery::query()->create($validated);

        // Create gallery image folder
        Storage::makeDirectory("public/galleries/$gallery->slug/orig");

        return redirect(route('galleries.index'))->withSuccess('created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery): Response|ResponseFactory
    {
        $gallery->load('images');

        return inertia('Admin/Galleries/Show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): Response|ResponseFactory
    {
        $gallery->load('images');

        return inertia('Admin/Galleries/CreateEdit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Gallery $gallery):RedirectResponse
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        //dd(tmr(), $request->all(), $request->validated(), $gallery);
        $validated = $request->validated();

        $gallery->update($validated);

        return redirect(route('galleries.edit', $gallery))->withSuccess('updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect(route('galleries.index'))->withSuccess('deleted!');
    }
}
