<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('checkadmin')->except('index','show');
    }

    public function index()
    {
        $voitures = Voiture::with('categorie')->orderBy('id','desc')->simplePaginate(7);
        return view('voitures.voitures',compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('voitures.add_voiture',compact('categories'));
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
            'nom'=>'required',
            'description'=>'required',
            'prix'=>'required',
            'matricule'=>'required',
            'photo_ext'=>"required",
        ]);

        if($request->hasFile('photo_ext')){
            $ext = $request->photo_ext->storeAs('voitures',time().'1.'.$request->photo_ext->extension(),'public');
        }
        if($request->hasFile('photo_int')){
            $int = $request->photo_int->storeAs('voitures',time().'2.'.$request->photo_int->extension(),'public');
        }
        if($request->hasFile('photo_avt')){
            $avt = $request->photo_avt->storeAs('voitures',time().'3.'.$request->photo_ext->extension(),'public');
        }
        if($request->hasFile('photo_arr')){
            $arr = $request->photo_arr->storeAs('voitures',time().'4.'.$request->photo_arr->extension(),'public');
        }

        Voiture::create([
            'nom'=>$request['nom'],
            'description'=>$request['description'],
            'matricule'=>$request['matricule'],
            'prix'=>$request['prix'],
            'categorie_id'=>$request['categorie_id'],
            'disponibilite'=>"Disponible",
            'photo_ext'=>$ext,
            'photo_int'=>$int,
            'photo_avt'=>$avt,
            'photo_arr'=>$arr
        ]);
        return redirect()->route('voitures.index')->with('success','Une voiture a été ajouter!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function show(int $voiture)
    {
        $voiture = Voiture::find($voiture);
        $voiture->load('categorie');
        return view('voitures.view_voiture',compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function edit(int $voiture)
    {
        $data['voiture'] = Voiture::find($voiture);
        $data['voiture']->load('categorie');
        $data['categories'] = Categorie::all();

        return view('voitures.update_voiture',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $voiture)
    {
        $voiture_update = Voiture::find($voiture);
        $voiture = [];
        $request->validate([
            'nom'=>'required',
            'description'=>'required',
            'prix'=>'required',
            'matricule'=>'required',
        ]);

        $voiture['nom']=$request['nom'];
        $voiture['description']= $request['description'];
        $voiture['matricule'] = $request['matricule'];
        $voiture['prix'] = $request['prix'];


        if($request->hasFile('photo_ext')){
            $ext = $request->photo_ext->storeAs('voitures',time().'1.'.$request->photo_ext->extension(),'public');
            $voiture['photo_ext']=$ext;
        }
        if($request->hasFile('photo_int')){
            $int = $request->photo_int->storeAs('voitures',time().'2.'.$request->photo_int->extension(),'public');
            $voiture['photo_int']=$int;
        }
        if($request->hasFile('photo_avt')){
            $avt = $request->photo_avt->storeAs('voitures',time().'3.'.$request->photo_ext->extension(),'public');
            $voiture['photo_avt']=$avt;
        }
        if($request->hasFile('photo_arr')){
            $arr = $request->photo_arr->storeAs('voitures',time().'4.'.$request->photo_arr->extension(),'public');
            $voiture['photo_arr']=$arr;
        }
        $voiture_update->update($voiture);

        return redirect()->route('voitures.index')->with('success','Voius avez modifié les détailles de la voiture '.$voiture_update['nom'].'!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voiture  $voiture
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $voiture)
    {
        Voiture::destroy($voiture);
        return redirect()->back()->with('success','Une voiture a été retiré!');
    }
}
