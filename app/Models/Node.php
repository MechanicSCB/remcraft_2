<?php

namespace App\Models;

use App\Classes\TreeHandler;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Node extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static string $separator = '.';

    public static function getMenu(): array
    {
        $nodes = DB::table('nodes')
            ->leftJoin('pages', 'page_id', '=', 'pages.id')
            ->orderBy('level') // if you use getTree or data_set in getTreeRec nodes must be sorted by level
            ->orderBy('order')
            ->get(['nodes.id', 'nodes.title', 'parent_path', 'path', 'level', 'order', 'href', 'slug']);

        // return (new TreeHandler())->getTree(stdToArray($nodes));
        return (new TreeHandler())->getOrderedTree(stdToArray($nodes));
    }

    /**
     * Get node's parent
     */
    protected function parent(): Attribute
    {
        return Attribute::make(
            get: fn() => Node::query()
                ->where('path', '=', $this['parent_path'])
                ->first(['id', 'title', 'page_id', 'order', 'path', 'parent_path']),
        );
    }

    /**
     * Get node's children
     */
    protected function children(): Attribute
    {
        return Attribute::make(
            get: fn() => Node::query()
                ->where('parent_path', '=', $this['path'])
                ->orderBy('order')
                ->get(['id', 'title', 'page_id', 'order', 'path', 'parent_path']),
        );
    }

    /**
     * Refresh node children nodes ordering.
     */
    public function reorderSiblings()
    {
        $this->parent->reorderChildren();
    }

    /**
     * Refresh node children nodes ordering.
     */
    public function reorderChildren()
    {
        $nodes = $this->children->toArray();

        foreach ($nodes as $key => &$node) {
            $node['order'] = $key + 1;
        }

        Node::query()->upsert($nodes, 'id', ['id', 'order']);
    }
}
