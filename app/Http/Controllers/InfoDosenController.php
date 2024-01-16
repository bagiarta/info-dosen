<?php

namespace App\Http\Controllers;

use App\Models\LecturerPublication;
use App\Models\PublicationCategory;
use App\Models\User;
use Illuminate\Http\Request;

class InfoDosenController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'dosen')->with('lecturer_user')->get();
        return view('front-page.info-dosen.index', [
            'users' => $users
        ]);
    }
    public function detail($encrypt_id)
    {
        $user = User::where('encrypt_id', $encrypt_id)->with(['lecturer_user' => function ($query){
            $query->with('religion');
        }])->first();
        $publications = PublicationCategory::with(['publication_sub_categories' => function ($query) use ($user) {
            $query->with([
                'lecturer_publications' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            ])->whereHas('lecturer_publications', function ($query) use ($user){
                $query->where('user_id', $user->id);
            });
        }])
        ->whereHas('lecturer_publications', function ($query) use ($user){
            $query->where('user_id', $user->id);
        })
        ->get();
        return view('front-page.info-dosen.detail', [
            'user' => $user,
            'publications' => $publications
        ]);
    }
}
