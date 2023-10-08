<?php

namespace App\Http\Controllers;

use App\Actions\Images\SyncGalleryImages;
use App\Http\Requests\UploadImgRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageControllerOld extends Controller
{
    public function upload(UploadImgRequest $request, Gallery $gallery): RedirectResponse
    {
        $dir = "galleries/$gallery->slug/orig";
        $lastKey = +Str::beforeLast(Str::afterLast(last(Storage::files("public/$dir")), '/'), '.');

        foreach ($request->validated('photos') ?? [] as $key => $photo) {
            // increment the last filename
            $filename = str_pad($lastKey + $key + 1, 3, 0, STR_PAD_LEFT);
            $ext = Str::afterLast($photo->guessExtension(), '/');
            $photo->storePubliclyAs($dir, "$filename.$ext", ['disk' => 'public']);
        }

        (new SyncGalleryImages($gallery))();

        return redirect()->back()->with('success', 'Uploaded!');
    }

    public function sync(Gallery $gallery): RedirectResponse
    {
        // $dir = "/public/galleries/$gallery->slug/orig";
        // $files = Storage::files($dir);
        // dd(tmr(),$files);
        (new SyncGalleryImages($gallery))();
        //$gallery->syncImages();

        return redirect()->back()->with('success', 'Synchronized!');
    }

    public function destroy(Gallery $gallery, string $filename): RedirectResponse
    {
        Storage::delete("public/galleries/$gallery->slug/orig/$filename");
        (new SyncGalleryImages($gallery))();
        //$gallery->syncImages();

        return back()->with('success', 'image deleted');
    }
}
