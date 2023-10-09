<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class BlockController extends Controller
{
    public function getBlocks(Request $request, Page $page): Collection
    {
        $blocks = $page->blocks()->with('component.galleries.images')
            ->skip($request['from'])
            ->take(3)
            ->get()
        ;

        return $blocks;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block): Response|ResponseFactory
    {
        $block->load('component.galleries.images');

        return inertia('Admin/Blocks/Show', compact('block'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        //
    }
}
