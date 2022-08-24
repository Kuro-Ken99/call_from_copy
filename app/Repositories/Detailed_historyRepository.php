<?php

namespace App\Repositories;

use App\Detailed_history;
use Illuminate\Support\Facades\Auth;

class Detailed_historyRepository
{
    public function getToMeList()
    {
        $id = Auth::id();
        return Detailed_history::where('to_whom', '=', $id)->orderBy('created_at', 'desc')->get();
    }

    public function createHistory(int $toWhom, string $fromWhom, string $business, string $correspondence, string $phoneNumber)
    {
        $id = Auth::id();
        Detailed_history::create([
            'to_whom' => $toWhom,
            'from_whom' => $fromWhom,
            'business' => $business,
            'correspondence' => $correspondence,
            'phone_number' => $phoneNumber,
            'sent_by' => $id,
        ]);
    }

    public function deleteHistory(int $historyId)
    {
        Detailed_history::find($historyId)->delete();
    }
}
