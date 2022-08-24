<?php

namespace App\Http\Controllers;

use App\Repositories\Detailed_historyRepository;
use App\Repositories\Rough_historyRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\MyClasses\Util;

class HomeController extends Controller
{
    private Detailed_historyRepository $detailed_historyRepository;
    private Rough_historyRepository $rough_historyRepository;
    private UserRepository $userRepository;

    public function __construct(Detailed_historyRepository $detailed_historyRepository, Rough_historyRepository $rough_historyRepository, UserRepository $userRepository)
    {
        $this->middleware('verified');
        $this->detailed_historyRepository = $detailed_historyRepository;
        $this->rough_historyRepository = $rough_historyRepository;
        $this->userRepository = $userRepository;
    }

    public function getHomeView()
    {
        $toMeList = $this->detailed_historyRepository->getToMeList();
        $byMeList = $this->rough_historyRepository->getByMeList();
        $users = $this->userRepository->getUsersList();
        return view('contents.home')->with([
            'toMeList' => $toMeList,
            'byMeList' => $byMeList,
            'users' => $users,
        ]);
    }

    public function search(Request $request)
    {
        $searchWord = Util::mbTrim($request->input('name'));
        $results = $this->userRepository->search($searchWord);

        return view('contents.results')->with('results', $results);
    }

    public function getMypageView()
    {
        return view('contents.mypage');
    }

    public function getUpdateView()
    {
        return view('contents.update');
    }
}
