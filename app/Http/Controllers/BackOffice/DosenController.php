<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\LecturerUser;
use App\Models\Religion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = LecturerUser::with('user');
        if (auth()->user()->role == 'dosen') {
            $dosens->where('user_id', auth()->user()->id);
        }
        $dosens = $dosens->get();
        return view('back-office.dosen.index', [
            'dosens' => $dosens
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $religions = Religion::get();
        return view('back-office.dosen.create', [
            'religions' => $religions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'nip' => 'required|unique:lecturer_users,nip',
            'nidn' => 'required|unique:lecturer_users,nidn',
            'password' => 'required',
            'status' => 'required',
            'religion' => 'required'
        ]);
        $id = DB::select("SELECT LAST_INSERT_ID() AS last_insert_id FROM users");
        $crypt_id = Crypt::encrypt($id == NULL ? 1 : $id[0]->last_insert_id + 1);
        $photo = NULL;
        $random_string = Str::random(100);
        if ($request->file('photo') != NULL) {
            $photo = $random_string . '.' . $request->photo->getClientOriginalExtension();
            $a = $request->photo->storeAs('asset_dosen/profile_pictures/', $photo, ['disk' => 'public_path']);
            // dd($a);
        }
        $user = User::create([
            'name' => $request->name,
            'encrypt_id' => $crypt_id,
            'email' => $request->email,
            'photo' => 'asset_dosen/profile_pictures/' . $photo,
            'password' => Hash::make($request->password),
            'role' => 'dosen'
        ]);
        LecturerUser::create([
            'user_id' => $user->id,
            'religion_id' => $request->religion,
            'nip' => $request->nip,
            'nidn' => $request->nidn,
            'status' => $request->status,
            'lecturer_status' => $request->lecturer_status,
            'is_active' => $request->is_active,
            'faculty' => $request->faculty,
            'study_program' => $request->study_program,
            'birthday' => $request->birthday,
            'description' => $request->description,
            'topic' => $request->topic,
        ]);
        return redirect()->route('backoffice.dosen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen = User::where('id', $id)->with('lecturer_user')->first();
        $religions = Religion::get();
        return view('back-office.dosen.edit', [
            'dosen' => $dosen,
            'religions' => $religions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required',
            'nip' => 'required|unique:lecturer_users,nip,' . $id . ',user_id',
            'status' => 'required',
            'religion' => 'required'
        ]);
        $oldUser = User::where('id', $id)->with('lecturer_user')->first();
        $photo = NULL;
        if ($request->photo != NULL) {
            Storage::disk('public_path')->delete($oldUser->photo);
            $random_string = Str::random(100);
            $photo = $random_string . '.' . $request->photo->getClientOriginalExtension();
            $a = $request->photo->storeAs('asset_dosen/profile_pictures/', $photo, ['disk' => 'public_path']);
            // dd($a);
        }
        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = $oldUser->password;
        }
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $photo == NULL ? $oldUser->photo : 'asset_dosen/profile_pictures/' . $photo,
            'password' => $password,
        ]);
        LecturerUser::where('user_id', $id)->update([
            'religion_id' => $request->religion,
            'nip' => $request->nip,
            'status' => $request->status,
            'lecturer_status' => $request->lecturer_status,
            'is_active' => $request->is_active,
            'faculty' => $request->faculty,
            'study_program' => $request->study_program,
            'birthday' => $request->birthday,
            'description' => $request->description,
            'topic' => $request->topic,
        ]);
        return redirect()->route('backoffice.dosen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oldUser = User::where('id', $id)->with('lecturer_user')->first();

        $a = Storage::disk('public_path')->delete($oldUser->photo);
        User::where('id', $id)->with('lecturer_user')->delete();
        // User::where
        return redirect()->route('backoffice.dosen.index');
    }
}
