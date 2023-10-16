<?php


namespace App\Actions\Nodes;


use App\Models\Node;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use JetBrains\PhpStorm\ArrayShape;

class MoveNode
{
    #[ArrayShape(['type' => "string", 'body' => "string"])]
    public function moveNode(Node $targetNode, Node $destNode): array
    {
        $sep = Node::$separator;
        // check that the destination node is already parent of target node ($node['parent_path'] === $parentNode['id'])
        // if you remove this check, the nodes will simply be updated unchanged (only updated_at will change) for copy and for move actions both
        if ($targetNode['parent_path'] === $destNode['path']) {
            return ['type' => 'warning', 'body' => __('flash.the_destination_node_is_already_parent_of_target_node')];
        }

        // forbid moving the node into itself
        if ($targetNode['path'] === $destNode['path']) {
            return ['type' => 'error', 'body' => __('flash.moving_a_node_into_itself_is_prohibited')];
        }

        // forbid moving the node into its descendants
        if (str_starts_with($destNode['path'], $targetNode['path'] . $sep)) {
            return ['type' => 'error', 'body' => __('flash.moving_a_node_into_its_descendants_is_prohibited')];
        }

        $keys = ['id', 'parent_path', 'path', 'order'];

        // Get target descendants if they exist as array of arrays with selected fields
        $targetDescendants = stdToArray(DB::table('nodes')
            ->where('path', 'like', "{$targetNode['path']}$sep%")
            ->get($keys));

        // Update target descendants paths and parent paths
        $oldParentPath = $sep . $targetNode['path'] . $sep;
        $newParentPath = $sep . $destNode['path'] . $sep . $targetNode['id'] . $sep;

        foreach ($targetDescendants as &$descendant) {
            $descendant['path'] = trim(str_replace($oldParentPath, $newParentPath, $sep . $descendant['path'] . $sep), $sep);
            $descendant['parent_path'] = trim(str_replace($oldParentPath, $newParentPath, $sep . $descendant['parent_path'] . $sep), $sep);
        }

        // Get target node as array with selected fields
        $targetNodeArr = stdToArray(DB::table('nodes')->where('path', '=', $targetNode['path'])->first($keys));

        // Update the path to the target node and the parent path
        $targetNodeArr['parent_path'] = $destNode['path'];
        $targetNodeArr['path'] = $destNode['path'] . $sep . $targetNodeArr['id'];
        // put target at the end of the destination's node list
        $targetNodeArr['order'] = 999;

        // Merge the array of the target node and the arrays of its descendants
        $nodesToUpdate = [$targetNodeArr, ...$targetDescendants];

        // upsert database table
        Schema::disableForeignKeyConstraints();
        Node::query()->upsert($nodesToUpdate, 'id', ['id', 'path', 'parent_path', 'order']);
        Schema::enableForeignKeyConstraints();

        // Reorder children nodes in destination node and target parent node
        $destNode->reorderChildren();
        $targetNode->parent->reorderChildren();

        return ['type' => 'success', 'body' => __('flash.successfully_moved')];
    }
}
