<?php

namespace App\Http\Controllers;

use App\Repositories\Detailed_historyRepository;
use App\Repositories\Rough_historyRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\MyClasses\Util;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Mail\NotificationMails;

class CRUDController extends Controller
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

    public function create(Request $request)
    {
        // 全角空白をtrim
        $toWhom = $request->input('to_whom');
        $fromWhom = Util::mbTrim($request->input('from_whom'));
        $business = Util::mbTrim($request->input('business'));
        $correspondence = Util::mbTrim($request->input('correspondence'));
        $phoneNumber = Util::mbTrim($request->input('phone_number'));

        // requestの配列を、trim後の値で置換
        $array = $request->all();
        $array['from_whom'] = $fromWhom;
        $array['business'] = $business;
        $array['correspondence'] = $correspondence;
        $array['phone_number'] = $phoneNumber;

        $validator = Validator::make($array, [
            'to_whom' => ['required'],
            'from_whom' => ['string', 'required', 'max:50'],
            'business' => ['required', 'max:1000'],
            'correspondence' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                ->withErrors($validator)
                ->withInput();
        }

        $this->detailed_historyRepository->createHistory($toWhom, $fromWhom, $business, $correspondence, $phoneNumber);
        $this->rough_historyRepository->createHistory($toWhom, $fromWhom, $business);

        $user = $this->userRepository->searchById($toWhom);
            $name = $user->name;
            $email = $user->email;
            $sentBy = Auth::user()->name;

            Mail::send(new NotificationMails($name, $email, $fromWhom, $business, $sentBy));

        return redirect('/home')->with('message', '伝言を送信しました♪');
    }

    public function delete(int $historyId)
    {
        $this->detailed_historyRepository->deleteHistory($historyId);

        return redirect('/home');
    }

    public function delete_rough(int $historyId)
    {
        $this->rough_historyRepository->deleteHistory($historyId);

        return redirect('/home');
    }

    public function update(Request $request)
    {

        // 全角空白をtrim
        $name = Util::mbTrim($request->input('name'));
        $kana = Util::mbTrim($request->input('kana'));
        $department = Util::mbTrim($request->input('department'));
        $extension = Util::mbTrim($request->input('extension'));


        // requestの配列を、trim後の値で置換
        $array = $request->all();
        $array['name'] = $name;
        $array['kana'] = $kana;
        $array['department'] = $department;
        $array['extension'] = $extension;

        $validator = Validator::make($array, [
            'name' => ['required', 'string', 'max:30'],
            'kana' => ['required', 'string', 'max:30', 'regex:/^[\p{Hiragana}|ー]+$/u'],
            'department' => ['nullable', 'string'],
            'extension' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect('/update')
                ->withErrors($validator)
                ->withInput();
        }

        $this->userRepository->update($name, $kana, $department, $extension);

        return redirect('/mypage')->with('message', '更新が完了しました♪');
    }

    public function deleteAccount(Request $request)
    {
        $password = $request->input('password');
        $user = Auth::user();
        if (Hash::check($password, $user->password)) {
            Auth::logout();
            $user->delete();
            return redirect('/');
        }
        return redirect('/mypage')->with('wrong_pass', 'パスワードが違います');
    }
}
