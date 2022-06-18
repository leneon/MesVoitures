<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Facade\Ignition\SolutionProviders\ViewNotFoundSolutionProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paiement(int $reservation){

        $reservation = Reservation::find($reservation);
        $reservation->load('client','voiture');
        if($reservation->voiture->disponibilite=="Louer")
            return back()->with('error',$reservation->voiture->nom.' est en location de '.$reservation['nbre_jrs'].' depuis le '.date('d-m-Y', strtotime($reservation['date'])).'. Merci de patienter !');

        return view('paiements.paiement',compact('reservation'));
    }

    public function index()
    {
        if(Auth::user()->type=="client")
            $reservations = Reservation::where('client_id',Auth::user()->id)->whereStatutAndEtat('Accepter','active')->simplePaginate(10);
        else
            $reservations = Reservation::whereStatutAndEtat('Accepter','active')->simplePaginate(10);
        $reservations->load('client','voiture'); //,'reservation.client','reservation.voiture'
        return view('paiements.paiements',compact('reservations'));
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
        $data = [];
        $request->validate([
            'reference'=>'required'
        ]);
        $data['reservation_id'] = $request['reservation_id'];
        $data['montant']= $request['total'];
        $data['reference'] = $request['reference'];
        $data['methode'] = $request['methode'];
        $data['caution'] = $request['caution'];

        if(Paiement::create($data))
        {
            $reservation = Reservation::find($data['reservation_id']);
            $reservation->load('client','voiture');
            $reservation->update(['numero'=>"ATIKO-".str_pad($reservation['id'],4, "0000", STR_PAD_LEFT),]);
            $reservation->voiture->update(['disponibilite'=>"Louer"]);

            if(Auth::user()->type=="client")
            return redirect()->route('paiements.index')->with('success','Vous venez d\'effectuer un paiement pour le reservation '.$reservation->voiture->nom.' !');

            return redirect()->route('paiements.index')->with('success','Vous venez d\'effectuer un paiment pour la reservation de '.$reservation->voiture->nom.' à '.$reservation->client->nom.' !');

        }else
            return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show(Paiement $paiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function edit(Paiement $paiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paiement $paiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paiement $paiement)
    {
        //
    }
}
