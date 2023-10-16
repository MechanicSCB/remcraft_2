<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImgRequest;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
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
            $image = Image::query()->create([
                'order' => intval($filename),
                'name' => $filename,
                'ext' => $ext,
                'gallery_id' => $gallery['id'],
            ]);

            $image->createOptimized();
        }

        return redirect()->back()->with('success', 'Uploaded!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image): RedirectResponse
    {
        $image->remove();
        $image->gallery->refreshOrders();

        return redirect()->back()->with('success', 'Deleted!');
    }

    /**
     * Reorder the specified resource
     */
    public function reorder(Image $image, int $order): RedirectResponse
    {
        $image['order'] = $order-0.5;
        $image->save();
        $image->gallery->refreshOrders();

        return redirect()->back()->with('success', 'порядок изменён');
    }
}
