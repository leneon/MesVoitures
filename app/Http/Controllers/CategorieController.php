<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::simplePaginate(10);
        return view('categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.add_categorie');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|string',
            'description'=>'required|max:255'

        ]);
        Categorie::create([
            'nom'=>$request['nom'],
            'description'=>$request['description']
        ]);
        return redirect()->route('categories.index')->with('success','vous avez ajouter une catégorie!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(int $categorie)
    {
        $categorie = Categorie::find($categorie);
        return view('categories.update_categorie',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $categorie)
    {
        $request->validate([
            'nom'=>'required|string',
            'description'

        ]);
        $categorie = Categorie::find($categorie);
        $categorie->update([
            'nom'=>$request['nom'],
            'description'=>$request['description']
        ]);
        return redirect()->route('categories.index')->with('success','vous avez Modifier une catégorie!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categorie)
    {
        $cat = Categorie::find($categorie);
        $cat->delete();
        return back()->with('success','Vous avez supprimer une categorie!');
    }
}
