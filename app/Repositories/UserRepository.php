<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getUsersList()
    {
        return User::orderBy('kana', 'asc')->get();
    }

    public function search(string $searchWord)
    {
        return User::where('name', 'like', "%$searchWord%")->orWhere('kana', 'like', "%$searchWord%")->orWhere('department', 'like', "%$searchWord%")->get();
    }

    public function update(string $name, string $kana, string $department, string $extension)
    {
        Auth::user()->update([
            'name' => $name,
            'kana' => $kana,
            'department' => $department,
            'extension' => $extension,
        ]);
    }

    public function searchById(string $userId)
    {
        return User::find($userId);
    }
}
