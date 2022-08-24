<?php

namespace App\Repositories;

use App\Rough_history;
use Illuminate\Support\Facades\Auth;

class Rough_historyRepository
{
    public function getByMeList()
    {
        $id = Auth::id();
        return Rough_history::where('sent_by', '=', $id)->orderBy('created_at', 'desc')->get();
    }

    public function createHistory(int $toWhom, string $fromWhom, string $business)
    {
        $id = Auth::id();
        Rough_history::create([
            'to_whom' => $toWhom,
            'from_whom' => $fromWhom,
            'business' => $business,
            'sent_by' => $id,
        ]);
    }

    public function deleteHistory(int $historyId)
    {
        Rough_history::find($historyId)->delete();
    }
}
