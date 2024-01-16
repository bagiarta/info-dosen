<?php

namespace Database\Seeders;

use App\Models\LecturerPublication;
use App\Models\LecturerUser;
use App\Models\PublicationCategory;
use App\Models\PublicationSubCategory;
use App\Models\Religion;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // insert agama
        Religion::insert([[
            'name' => 'Hindu'
        ],[
            'name' => 'Islam'
        ],[
            'name' => 'Kristen'
        ],[
            'name' => 'Budha'
        ]]);
        // insert Publication Category dan sub category
        PublicationCategory::create([
            'name' => strtoupper('Penelitian Dosen'),
        ]);
        PublicationCategory::create([
            'name' => strtoupper('Pengabdian Dosen'),
        ]);
        PublicationSubCategory::insert([[
            'publication_category_id' => 1,
            'name' => 'Jurnal Ilmiah'
        ],[
            'publication_category_id' => 1,
            'name' => 'Prosiding'
        ]]);
        PublicationSubCategory::insert([[
            'publication_category_id' => 2,
            'name' => 'Memberi Pelayanan'
        ],[
            'publication_category_id' => 2,
            'name' => 'Memberi Pelatihan'
        ]]);
        // user su
        $id = DB::select("SELECT LAST_INSERT_ID() AS last_insert_id FROM users");
        User::create([
            'name' => 'superuser',
            'email' => 'superuser@markandeyabali.ac.id',
            'encrypt_id' => Crypt::encryptString($id == NULL ? 1 : $id[0]->last_insert_id+1),
            'password' => Hash::make('123456'),
            'role' => 'super_user'
        ]);

        // user admin
        $id = DB::select("SELECT LAST_INSERT_ID() AS last_insert_id FROM users");
        User::create([
            'name' => 'admin',
            'email' => 'admin@markandeyabali.ac.id',
            'encrypt_id' => Crypt::encryptString($id == NULL ? 1 : $id[0]->last_insert_id+1),
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        // user dosen
        $id = DB::select("SELECT LAST_INSERT_ID() AS last_insert_id FROM users");
        $iddosen = User::create([
            'name' => 'Dr. I Made Dosen A, M. Ked.',
            'email' => 'dosena@markandeyabali.ac.id',
            'photo' => 'asset_dosen/profile_pictures/eyJpdiI6InVDRERQZkdBVHE2YUxqYmVqU2Fobnc9PSIsInZhbHVlIjoiVkxkWUZLRGI0RDdHME9FSC9HcFE0dz09IiwibWFjIjoiYThjMzYwMzg2NzkzYmYwZWFkZjdjMTAyMTM3MDliNGEyNjMzZjM5NDI0ZGExZDIxNjIxZDEyMGJkNWE4MjhiOCIsInRhZyI6IiJ9.jpg',
            'encrypt_id' => Crypt::encryptString($id == NULL ? 1 : $id[0]->last_insert_id+1),
            'password' => Hash::make('123456'),
            'role' => 'dosen'
        ]);
        LecturerUser::create([
            'user_id' => $iddosen->id,
            'religion_id' => 1,
            'nip' => '12345678',
            'status' => 'PNS',
            'is_active' => 'aktif',
            'status' => 'Tersertivikasi',
            'lecturer_status' => 'PNS',
            'faculty' => 'Fakultas Kedokteran',
            'study_program' => 'Ilmu Kesehatan',
            'birthday' => '1967-01-01',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit laborum temporibus ducimus. Dolores dolor ratione quas, magnam delectus itaque necessitatibus beatae aliquid quos exercitationem nam in laborum omnis nobis nisi id? In, voluptatibus! Fugit facere rem sint, veniam deleniti velit quis unde molestias earum autem animi. Quis iusto molestias sunt?",
            'topic' => 'Ilmu Kesehatan, Ilmu Kedokteran',
        ]);
        LecturerPublication::create([
            'user_id' => $iddosen->id,
            'publication_category_id' => 1,
            'publication_sub_category_id' => 1,
            'author' => 'Test Author 1, Author 2, Author 3',
            'title' => 'Test Title 1',
            'file' => 'asset_dosen/publications/temp-test-publikasi.pdf',
            'published_at' => '2022-09-01',
            'published_in' => 'Jurnal Manajemen Indonesia. Universitas Pendidikan Ganesha. Vol.5',
            'url' => 'https://ejournal.undiksha.ac.id/index.php/JMI/article/view/8060'
        ]);
        
    }
}
