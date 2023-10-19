<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockRequest;
use App\Models\Block;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class BlockController extends Controller
{
    /**
     * Get not loaded blocks while page scrolling.
     */

    public function getBlocks(Request $request, Page $page): Collection
    {
        $blocks = $page->blocks()->with('component.galleries.images')
            ->skip($request['from'])
            ->take(3)
            ->get();

        return $blocks;
    }

    /**
     * Reorder block position
     */
    public function reorder(Block $block, int|float $order): RedirectResponse
    {
        $block['order'] = $order-0.5;
        $block->save();
        $block->page->refreshBlockOrders();

        return redirect()->back()->with('success', 'порядок изменён');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        // $query = Block::query()->with('component');
        $query = Block::query();

        // FILTER
        if (@$request['title']) {
            $query->whereRelation('component', 'title', 'like', "%$request->title%");
        }
        if (@$request['page_id']) {
            $query->where('page_id', '=', $request['page_id']);
        }
        if (@$request['type']) {
            $query->whereRelation('component', 'type', '=', $request['type']);
        }

        $blocks = $query->get();

        return inertia('Admin/Blocks/BlocksIndex', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Blocks/BlockCreateEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlockRequest $request): RedirectResponse
    {
        $block = Block::query()->create(array_filter($request->validated(), fn($v) => $v !== null));

        return redirect(route('blocks.edit', $block))->with('success', 'Сохранено!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Block $block): Response|ResponseFactory
    {
        $block->load('component.galleries.images');

        return inertia('Admin/Blocks/BlockShow', compact('block'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block): Response|ResponseFactory
    {
        $block->load('component.galleries', 'component.blocks');

        return inertia('Admin/Blocks/BlockCreateEdit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlockRequest $request, Block $block): RedirectResponse
    {
        $block->update($request->validated());

        return back()->with('success', 'Сохранено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block): RedirectResponse
    {
        $block->delete();

        return back()->with('success', 'блок удалён!');
    }
}
