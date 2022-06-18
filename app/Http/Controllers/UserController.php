<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('checkadmin');
    }

public function create(){
    return view('utilisateurs.ajouter');
}

    public function clients(){

        $data['clients'] = User::where('type','client')->get();

        return view('clients.clients',$data);
    }

    public function utilisateurs(){

        $data['utilisateurs'] = User::where('type','utilisateurs')->get();

        return view('utilisateurs;uitlisateurs',$data);
    }

    public function destroy(int $client){
        if(User::where('id',$client)->first())
            User::destroy($client);
        return redirect()->back()->with('success','Vous venez de supprimer ce client');
    }

    public function update(Request $request,User $user){
        $request->validate([
            'nom'=>'required|string',
            'email'=>'email',
            'adresse'=>'required|string',
            'telephone'=>'required|string',
            'num_carte'=>'required|string',
            'ville'=>'required|string',
             ]);

             $req = $request->all();

             if($request->hasFile('photo')){
                $filename = time().'.'.$request->photo->extension();
                $path = $request->photo->storeAs('avatars',$filename,'public');
                $req['photo']=$path;

            }

        $user_find = User::find($user['id']);
        $user_find->update($req);


        return redirect()->route('dashboard')->with('success','votre compte bien été modifier');

    }

    public function update_password(Request $request,User $user){
        $request->validate([
            'password'=>'required',
            'password_confirmation'=>'required'
        ]);
        if($request['password']!=$request['password_confirmation'])
            return back()->with('error','incohérence entre vos mots de passe');
            
        $user = User::find(Auth::user()->id);
        $user->update(['password'=>bcrypt($request['password'])]);
        DB::table('password_resets')->insert(['email'=>$user['email'],'token'=>$request['token'],'created_at'=>now()]);

        return redirect('dashboard')->with('success','Vous avez modifier votre mot de passe');

    }

    public function add_user(Request $request){
        $request->validate([
            'email'=>'required'
        ]);


        if($user = User::where('email',$request['email'])->first()){
            $user->update(['type'=>'employe']);
        }
        else
            User::create(['email'=>$request['email'],'password'=>bcrypt('123456789'),'type'=>'employe','droit'=>'w','nom'=>'New User']);

            return redirect('new_user')->with('success','Vous avez ajouter un utilisateur !');

    }

    public function new_user(){
        $users = User::where('type','employe')->simplePaginate();
            return view('utilisateurs.utilisateurs',compact('users'));

    }

    public function retirer(int $user){
        $user = User::find($user);
        $user->update(['type'=>"cleint"]);
        return back()->with('success','Vous avez banit '.$user['nom'].' des utilisateur de cet application !');
    }

}




