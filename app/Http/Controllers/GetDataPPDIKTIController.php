<?php

namespace App\Http\Controllers;

use App\Models\LecturerUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class GetDataPPDIKTIController extends Controller
{
    public function index()
    {
        $ppdikti = Http::withoutVerifying()->get('https://api-frontend.kemdikbud.go.id/hit/INSTITUT%20TEKNOLOGI%20DAN%20PENDIDIKAN%20MARKANDEYA%20BALI')->json();
        $ppdikti = $ppdikti['dosen'];
        $ppdikti_map = array_map(function ($data) {
            $id = explode('/', $data['website-link']);
            $data_dosen = explode(',', $data['text']);
            $data_dosen2 = array_map(function ($datas) {
                return explode(':', $datas);
            }, $data_dosen);
            return [
                'id' => $id[2],
                'data' => $data_dosen2
            ];
        }, $ppdikti);
        $data_dosens = [];
        foreach ($ppdikti_map as $ppdikti) {
            $users = [
                'name' => $ppdikti['data'][0][0],
                'nidn' => $ppdikti['data'][1][1],
                'prodi' => $ppdikti['data'][3][1]
            ];
            $ppdikti_detail = Http::withoutVerifying()->get('https://api-frontend.kemdikbud.go.id/detail_dosen/' . $ppdikti['id'])->json();
            $ppdikti_detail = $ppdikti_detail['dataumum'];
            $users['jenis_kelamin'] = $ppdikti_detail['jk'];
            $users['is_active'] = $ppdikti_detail['statuskeaktifan'];
            $users['lecturer_status'] = $ppdikti_detail['ikatankerja'];
            array_push($data_dosens, $users);
        }
        foreach ($data_dosens as $key => $dosen) {
            if($key != 5){

                $id = DB::select("SELECT LAST_INSERT_ID() AS last_insert_id FROM users");
                $crypt_id = Crypt::encrypt($id == NULL ? 1 : $id[0]->last_insert_id + 1);
                $user = User::create([
                    'encrypt_id' => $crypt_id,
                    'name' => $dosen['name'],
                    'role' => 'dosen',
                    'isActive' => 1,
                    'password' => Hash::make('123456'),
                ]);
                LecturerUser::create([
                    'user_id' => $user->id,
                    'nidn' => str_replace(" ","",$dosen['nidn']),
                    'jenis_kelamin' => $dosen['jenis_kelamin'],
                    'is_active' => $dosen['is_active'],
                    'lecturer_status' => $dosen['lecturer_status']
                ]);
            }
        }
        dd('success');
    }
}
