<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\ResponseFactory;

class ItemController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Admin/Items/Index');
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Items/Create');
    }
}
