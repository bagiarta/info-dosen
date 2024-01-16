<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\PublicationCategory;
use App\Models\PublicationSubCategory;
use Illuminate\Http\Request;

class PublicationSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pub_sub_cats = PublicationSubCategory::with('publication_category')->get();
        return view('back-office.publication-sub-category.index',[
            'pub_sub_cats' => $pub_sub_cats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pub_cats = PublicationCategory::get();
        return view('back-office.publication-sub-category.create',[
            'pub_cats' => $pub_cats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PublicationSubCategory::create([
            'publication_category_id' => $request->publication_category_id,
            'name' => $request->name
        ]);
        return redirect()->route('backoffice.publication-sub-category.index');
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
        $pub_cats = PublicationCategory::get();
        $pub_sub_cat = PublicationSubCategory::where('id',$id)->first();
        return view('back-office.publication-sub-category.edit',[
            'pub_cats' => $pub_cats,
            'pub_sub_cat' => $pub_sub_cat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        PublicationSubCategory::where('id',$id)->update([
            'publication_category_id' => $request->publication_category_id,
            'name' => $request->name
        ]);
        return redirect()->route('backoffice.publication-sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PublicationSubCategory::where('id',$id)->delete();
        return redirect()->route('backoffice.publication-sub-category.index');
    }
}
