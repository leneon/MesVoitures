<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voiture;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function form_reservation(int $voiture){
        $data['voiture'] = Voiture::find($voiture);

        $data['voiture']->load('categorie');
        $data['clients'] = User::where('type','client')->get();

        return view('reservations.form_reservation',$data);
    }

    public function new_reservation(){

        $voitures = Voiture::with('categorie')->simplePaginate(10);
        return view('reservations.new_reservation',compact('voitures'));
    }
    public function index()
    {
        if(Auth::user()->type=="client")
            $reservations = Reservation::where('client_id',Auth::user()->id)->orderBy('etat','asc')->simplePaginate(10);
        else
            $reservations = Reservation::orderBy('id','desc')->simplePaginate(10);
        $reservations->load('client','employe','voiture');
        return view('reservations.reservations',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[];
        if($request['nbre_jrs']>7)
            $request['nbre_jrs']=7;

            $data['nbre_jrs']=$request['nbre_jrs'];
        $data['voiture_id']=$request['voiture_id'];
        $data['date']=now();

        if(Auth::user()->type=="client"){
            $data['client_id']=$request['client_id'];
        }
        else{
            $data['statut']="Accepter";
            $data['employe_id']=$request['employe_id'];

            if($request['client']=="ancien"){
                $data['client_id']=$request['client_id'];
                $client = User::find($request['client_id']);
            }
            if($request['client']=="nouveau"){
                $request->validate([
                    'nom'=>'required',
                    'telephone'=>'required',
                    'num_carte'=>'required',
                    'adresse'=>'required',
                    'email'=>'required|email'
                ]);
                $client = User::create([
                    'nom'=>$request['nom'],
                    'email'=>$request['email'],
                    'telephone'=>$request['telephone'],
                    'num_carte'=>$request['num_carte'],
                    'adresse'=>$request['adresse'],
                    'password'=>bcrypt("123456789"),
                    'type'=>"client",
                    'droit'=>"r"
                ]);
                $data['client_id'] = $client['id'];
            }

        }

        Reservation::create($data);

        if(Auth::user()->type!="client")
            return redirect()->route('dashboard')->with('success','Vous venez de faire une reservation pour '.$client['nom'].' !');

            return redirect()->route('dashboard')->with('success','Vous venez d\'effectuer une reservation ! ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(int $reservation)

    {
        $data['reservation'] = Reservation::find($reservation);
        $data['reservation']->load('client','employe','voiture');

        if($data['reservation']['etat']=="inactive")
            return redirect()->route('reservations.index')->with('error','Vous ne pas modifier une location qui est a sa terme!');

        $data['clients']=User::where('type','client')->get();

        return view('reservations.update_reservation',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Reservation  $reservation
     */
    public function update(Request $request, int $reservation)
    {
        $reservation = Reservation::find($reservation);

        $reservation->load('client','employe','voiture');

        $data=[];
        if($request['nbre_jrs']>7)
            $request['nbre_jrs']=7;

            $data['nbre_jrs']=$request['nbre_jrs'];
        $data['voiture_id']=$request['voiture_id'];
        $data['date']=now();
        $data['statut']="enattente";

        if(Auth::user()->type=="client"){
            $data['client_id']=$request['client_id'];
        }
        else{
            $data['statut']="Accepter";
            $data['employe_id']=$request['employe_id'];

            if($request['client']=="ancien"){
                $data['client_id']=$request['client_id'];
            }
            if($request['client']=="nouveau"){
                $request->validate([
                    'nom'=>'required',
                    'telephone'=>'required',
                    'num_carte'=>'required',
                    'adresse'=>'required',
                    'email'=>'required|email'
                ]);
                $reservation->client->update([
                    'nom'=>$request['nom'],
                    'email'=>$request['email'],
                    'telephone'=>$request['telephone'],
                    'num_carte'=>$request['num_carte'],
                    'adresse'=>$request['adresse']
                ]);
            }

        }

        $reservation->update($data);
        if(Auth::user()->type!="client")
            return redirect()->route('reservations.index')->with('success','Vous venez de modifier la reservation de '.$reservation->client->nom.'!');

            return redirect()->route('reservations.index')->with('success','Vous venez d\'effectuer la modification de votre reservation '.$reservation->voiture->nom.' !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function approuver(int $reservation){
        $reservation = Reservation::find($reservation);
        $reservation->update(['statut'=>"Accepter"]);
        return back()->with('success','Vous avez Approuver cette reservation!');
    }

    public function annuler(int $reservation){

        $reservation = Reservation::find($reservation);
        $reservation->load('client');
        if($reservation['etat']=="inactive")
        return redirect()->route('reservations.index')->with('error','Vous ne pas modifier une location qui est a sa terme!');


        $reservation->update(['statut'=>"Rejeter"]);
        return back()->with('success','Vous avez Annuler une reservation de '.$reservation->client->nom.'!');
    }
    public function destroy(int $reservation)
    {
      $reservation = Reservation::destroy($reservation);
      return back()->with('success','Vous venez de Retirer une reservation!');
    }

    public function locations(){
        if(Auth::user()->type=="client")
            $reservations = Reservation::where('numero','<>',null)->where('client_id',Auth::user()->id)->orderBy('etat')->simplePaginate(10);
        else
            $reservations = Reservation::where('numero','<>',null)->orderBy('etat')->simplePaginate(10);
        $reservations->load('voiture');

        return view('reservations.locations',compact('reservations'));
    }

    public function retourner(int $reservation){
        $reservation = Reservation::find($reservation);
        $reservation->update(['etat'=>'inactive']);
        $reservation->voiture->update(['disponibilite'=>'Disponible']);

        if(Auth::user()->type=="client")
        return back()->with('success','Vous venez de retournez '.$reservation->voiture->nom.' !');
        return back()->with('success','Vous venez de retournez '.$reservation->voiture->nom.' louer par '.$reservation->client->nom.'!');

    }
}
