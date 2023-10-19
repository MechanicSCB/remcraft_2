<?php


namespace App\Classes;


use App\Models\Node;

class TreeHandler
{
    /**
     * Sort all nodes by order recursively
     */
    public function getOrderedTree(array $nodes): array
    {
        return $this->getOrderedNodes($this->getTree($nodes));
    }

    public function getOrderedNodes(?array $nodes): array
    {
        if (!$nodes) return [];

        $ordered = [];

        foreach ($nodes as $node) {
            $node['nodes'] = $this->getOrderedNodes(@$node['nodes']);

            $ordered[$node['order']] = $node;
        }

        return  $ordered;
    }

    /**
     * Reference tree making function, it works much faster (3-5 times on big trees), than getTreeRec with addNodeToTree recursive function
     * Require sorting nodes by level
     * if you don't use reference and set nodes to tree directly, it can be a little faster on big deep trees
     */
    public function getTree(array $nodes): array
    {
        $tree = [];

        foreach ($nodes as $node) {
            $keys = explode(Node::$separator, $node['parent_path'] ?? '');

            $tmp = &$tree;

            for ($i = 0; $i < $node['level']; $i++) {
                $tmp = &$tmp[$keys[$i]]['nodes'];
            }

            $tmp[$node['id']] = $node;
        }

        return $tree;
    }

    /**
     * Recursive tree making function, use data_set function analog for each node
     * Does not require sorting nodes by level
     */
    public function getTreeRec(array $nodes): array
    {
        $tree = [];

        foreach ($nodes as $node) {
            $parentIds = explode(Node::$separator, $node['parent_path']);

            if ($node['level'] === 0) {
                $key = $node['id'];
            } else {
                $key = implode('.nodes.', $parentIds) . '.nodes.' . $node['id'];
            }

            $keys = explode('.', $key);

            $this->addNodeToTree($tree, $keys, $node);
        }

        return $tree;
    }

    /**
     * Laravel data_set analog, but it works about twice faster in this case due to fewer checks
     * and also does not require sorting nodes by level
     */
    public function addNodeToTree(&$tree, $keys, $node): array
    {
        $key = array_shift($keys);

        if (!$keys) {
            return $tree[$key] = [...$tree[$key] ?? [], ...$node];
        }

        return $this->addNodeToTree($tree[$key], $keys, $node);
    }
}
