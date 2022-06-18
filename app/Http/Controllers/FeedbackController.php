<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('checkadmin')->except('create','store');
    }
    public function index()
    {
        $feedbacks = Feedback::simplePaginate(10);

        return view('feedbacks.feedbacks',compact('feedbacks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedbacks.new_feedback');
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
            'contenue'=>'required',
        ]);
        Feedback::create(['contenue'=>$request['contenue'],'client_id'=>Auth::user()->id]);
        return redirect('dashboard')->with('success','Vous venez de donnez votre avis sur notre service offert, Merci!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(int $feedback)
    {
        $feedback = Feedback::find($feedback);
        return view('feedbacks.show_feedback',compact('feedback'));
    }

    public function publier(int $feedback){
        $feedback = Feedback::find($feedback);
        $feedback->update(['statut'=>"publie"]);

        return back()->with('success','Vous avez publier une publication de '.$feedback->client->nom.' !');
    }

    public function retirer(int $feedback){
        $feedback = Feedback::find($feedback);
        $feedback->update(['statut'=>"enattente"]);

        return back()->with('success','Vous avez annuler une publication de '.$feedback->client->nom.' !');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $feedback)
    {
        $feedback = Feedback::find($feedback);

        Feedback::destroy($feedback['id']);
        return back()->with('success','Vous avez retirer une publication de '.$feedback->client->nom.' !');

    }
}
