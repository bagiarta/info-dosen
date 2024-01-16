<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\LecturerPublication;
use App\Models\PublicationCategory;
use App\Models\PublicationSubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = LecturerPublication::with('user','publication_category','publication_sub_category')->get();
        $users = User::get();
        $categories = PublicationCategory::get();
        $sub_categories = PublicationSubCategory::get();
        return view('back-office.publication.index',[
            'publications' => $publications,
            'users' => $users,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->category){
            $publication_sub_categories = PublicationSubCategory::where('publication_category_id',$request->category)->get();
            return response()->json($publication_sub_categories);
        }
        $dosens = User::where('role','dosen')->get();
        $publication_categories = PublicationCategory::get();
        return view('back-office.publication.create',[
            'dosens' => $dosens,
            'publication_categories' => $publication_categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        LecturerPublication::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'author' => $request->author,
            'published_in' => $request->published_in,
            'publication_category_id' => $request->publication_category_id,
            'publication_sub_category_id' => $request->publication_sub_category_id,
            'published_at' => $request->published_at,
            'url' => $request->url,
        ]);
        return redirect()->route('backoffice.publication.index');
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
        $dosens = User::where('role','dosen')->get();
        $publication_categories = PublicationCategory::get();
        $publication = LecturerPublication::where('id',$id)->first();
        $publication_sub_categories = PublicationSubCategory::where('id',$publication->publication_sub_category_id)->get();
        return view('back-office.publication.edit',[
            'dosens' => $dosens,
            'publication_categories' => $publication_categories,
            'publication' => $publication,
            'publication_sub_categories' => $publication_sub_categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        LecturerPublication::where('id',$id)->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'author' => $request->author,
            'published_in' => $request->published_in,
            'publication_category_id' => $request->publication_category_id,
            'publication_sub_category_id' => $request->publication_sub_category_id,
            'published_at' => $request->published_at,
            'url' => $request->url,
        ]);
        return redirect()->route('backoffice.publication.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LecturerPublication::where('id',$id)->delete();
        return redirect()->route('backoffice.publication.index');
    }
}
