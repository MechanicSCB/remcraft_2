<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidStoreRequest;
use App\Http\Requests\BidUpdateRequest;
use App\Mail\BidMail;
use App\Models\Bid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Inertia\Response;
use Inertia\ResponseFactory;

class BidController extends Controller
{
    public function store(BidStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $bid = Bid::create([
            'name' => htmlspecialchars($validated['name']),
            'contact' => $validated['phone'] ?? $validated['email'],
            'desc' => htmlspecialchars($validated['desc']),
            'ip' => $request->ip(),
        ]);

        Mail::to('NikolayUlyanov@yandex.ru')->queue(new BidMail($bid));

        return back()->with('success', 'Заявка принята');
    }

    public function index(): Response|ResponseFactory
    {
        $bids = Bid::query()->latest('updated_at')->get();

        return inertia('Admin/Bids/Index', compact('bids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BidUpdateRequest $request, Bid $bid): RedirectResponse
    {
        $validated = $request->validated();

        $bid->update($validated);

        return back()->with('success', 'Обновлено!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid): RedirectResponse
    {
        $bid->delete();

        return back()->with('success', 'Заявка удалена!');
    }
}
