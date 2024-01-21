<?php

namespace App\Http\Controllers;

use App\Models\LecturerPublication;
use App\Models\PublicationCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InfoDosenController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'dosen')->with('lecturer_user')->get();
        $ppdikti = Http::withoutVerifying()->get('https://api-frontend.kemdikbud.go.id/hit/INSTITUT%20TEKNOLOGI%20DAN%20PENDIDIKAN%20MARKANDEYA%20BALI')->json();
        $ppdikti = $ppdikti['dosen'];
        $ppdikti_map = array_map(function ($data) {
            $id = explode('/',$data['website-link']);
            $data_dosen = explode(',',$data['text']);
            $data_dosen2 = array_map(function ($datas){
                return explode(':',$datas);
            },$data_dosen);
            return [
                'id' => $id[2],
                'data' => $data_dosen2
                // 'data' => explode(',',explode(':',$data['text'])),
            ];
        }, $ppdikti) ;
        // dd($ppdikti_map);
        return view('front-page.info-dosen.index', [
            'users' => $users,
            'ppdikti_map' => $ppdikti_map
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
    public function ppdikti_detail($id){
        $ppdikti_detail = Http::withoutVerifying()->get('https://api-frontend.kemdikbud.go.id/detail_dosen/'.$id)->json();
        return view('front-page.info-dosen.ppdikti-detail',[
            'ppdikti_detail' => $ppdikti_detail
        ]);
    }
}
