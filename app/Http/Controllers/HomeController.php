<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobbies;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get All Hoobies 
        $hobbies = Hobbies::all();

        return view('home',compact('hobbies'));
    }

    public function indexAjax(Request $request)
    {
        // Logged in User ID
        $id = auth()->user()->id;     

        $query = User::selectRaw('users.id, users.name, users.email,users.gender, hobbies.hobby_id, users.created_at, GROUP_CONCAT(hobbies.hobby_name) as hobbies , GROUP_CONCAT(hobbies.hobby_id) as hobby_ids')
             ->leftJoin('users_hobbies', 'users.id', '=', 'users_hobbies.user_id')
             ->leftJoin('hobbies', 'users_hobbies.hobby_id', '=', 'hobbies.hobby_id');

        // Skip Logged in User
        $query->where('users.id','!=',$id);

        if(!empty($request->gender)){
            $query->where('users.gender','=',$request->gender);
        }

        $query->groupBy('users.id');

        // Filter By Hobbies
        if(!empty($request->hobby_id)){
            $query->havingRaw("FIND_IN_SET('".$request->hobby_id."',hobby_ids)");
        }

        $query->orderBy('users.created_at','desc');

        $users = $query->get();  

        return view('indexajax',compact('users'));
    }
}
