<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\PublicationCategory;
use Illuminate\Http\Request;

class PublicationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pub_cats = PublicationCategory::get();
        return view('back-office.publication-category.index',[
            'pub_cats' => $pub_cats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back-office.publication-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PublicationCategory::create([
            'name' => $request->name
        ]);
        return redirect()->route('backoffice.publication-category.index');
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
        $pub_cat = PublicationCategory::where('id',$id)->first();
        return view('back-office.publication-category.edit',[
            'pub_cat' => $pub_cat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        PublicationCategory::where('id',$id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('backoffice.publication-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PublicationCategory::where('id',$id)->delete();
        return redirect()->route('backoffice.publication-category.index');
    }
}
