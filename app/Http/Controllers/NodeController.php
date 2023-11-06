<?php

namespace App\Http\Controllers;

use App\Actions\Nodes\MoveNode;
use App\Actions\Nodes\ReorderNode;
use App\Http\Requests\NodeRequest;
use App\Models\Node;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Response;
use Inertia\ResponseFactory;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        return inertia('Admin/Nodes/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Nodes/Edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NodeRequest $request): Redirector|RedirectResponse
    {
        $validated = $request->validated();
        $validated['path'] = $validated['parent_path'] . '.0';

        $node = Node::query()->create($validated);
        $node->update(['path' => $validated['parent_path'] . '.' . $node['id']]);
        $node->reorderSiblings();

        return redirect(route('nodes.index'))->with('success', 'Пункт меню создан');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Node $node): Response|ResponseFactory
    {
        return inertia('Admin/Nodes/Edit', compact('node'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NodeRequest $request, Node $node): RedirectResponse
    {
        $validated = $request->validated();

        $node->update($validated);

        return back()->with('success', 'updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node): RedirectResponse
    {
        $node->delete();

        return back()->with('success', 'updated!');
    }

    public function reorder(Node $targetNode, Node $destNode): RedirectResponse
    {
        $actionResultMsg = (new ReorderNode())->reorder($targetNode, $destNode['order']);

        return back()->with($actionResultMsg['type'], $actionResultMsg['body']);
    }

    public function move(Node $targetNode, Node $destNode): RedirectResponse
    {
        $actionResultMsg = (new MoveNode())->moveNode($targetNode, $destNode);

        return back()->with($actionResultMsg['type'], $actionResultMsg['body']);
    }

}
