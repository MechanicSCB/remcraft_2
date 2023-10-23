<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $query = Gallery::query()->with('images', 'component.blocks');

        // FILTER
        if (@$request['title']) {
            $query->where('title', 'like', "%$request->title%");
        }
        if (! is_null($request['page_id'])) {
            if($request['page_id'] === '0'){
                $query->doesntHave('component.blocks');
            }else{
                $query->whereRelation('component.blocks', 'page_id', '=', $request['page_id']);
            }
        }

        $query->latest();

        $galleries = $query->get();

        return inertia('Admin/Galleries/GalleriesIndex', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Galleries/GalleryCreateEdit');
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

        return inertia('Admin/Galleries/GalleryShow', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): Response|ResponseFactory
    {
        $gallery->load('images');

        return inertia('Admin/Galleries/GalleryCreateEdit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validated();

        $gallery->update($validated);

        return redirect(route('galleries.edit', $gallery))->withSuccess('updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        // Remove gallery folder
        File::deleteDirectory($gallery['folderPath']);

        return back()->with('success', 'Галерея удалена!');
    }
}
