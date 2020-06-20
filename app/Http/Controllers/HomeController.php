<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hobbies;
use App\User;
use App\Friends;
use DB;

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
        $user_id = auth()->user()->id;   

        // Get logged in user blocked by 
        $blockedByUsers = $this->getBlockedByUsers();  
        $blockedUsers = $this->getBlockedUsers();  

        $friendsIds = $this->getFriends();
        $friendRequestIds = $this->getFriendRequest();
        $sentfriendRequestIds = $this->getSentFriendRequest();

        $query = User::selectRaw('users.id, users.name, users.email,users.gender, hobbies.hobby_id, users.created_at, GROUP_CONCAT(hobbies.hobby_name) as hobbies , GROUP_CONCAT(hobbies.hobby_id) as hobby_ids')
             ->leftJoin('users_hobbies', 'users.id', '=', 'users_hobbies.user_id')
             ->leftJoin('hobbies', 'users_hobbies.hobby_id', '=', 'hobbies.hobby_id');

        // Skip Logged in User
        $query->where('users.id','!=',$user_id);

        // Skip users who had blocked the logged in user
        if(!empty($blockedByUsers)){
            $query->whereNotIn('users.id', $blockedByUsers);
        }

        // Filter by Gender
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

        return view('indexajax',compact('users','friendsIds','friendRequestIds','blockedUsers','sentfriendRequestIds'));
    }

    // Send Friend Request
    public function sendRequest(Request $request)
    {
        $user_id = auth()->user()->id;

        $user = Friends::create([
            'user_id' => $user_id,
            'friend_id' => $request->friend_id,
            'status' => 'sent']);
    }

    // Block User
    public function blockUser(Request $request)
    {
        $user_id = auth()->user()->id;

        $user = Friends::create([
            'user_id' => $user_id,
            'friend_id' => $request->friend_id,
            'status' => 'blocked']);    
    }

    // Accept Friend Request
    public function acceptRequest(Request $request)
    {
        $user_id = auth()->user()->id;

        $affectedRows = Friends::where('friend_id', '=', $user_id)
                        ->where('status', '=', 'sent')
                        ->where('user_id', '=', $request->friend_id)
                        ->update(['status' => 'accepted']); 
    }

    // Blocked By users
    public function getBlockedByUsers()
    {
        $user_id = auth()->user()->id;

        $blokedUsers = Friends::where('friend_id', '=', $user_id)
                        ->where('status', '=', 'blocked')->pluck('user_id')->toArray();

        return $blokedUsers;    
    }

    // Get Blocked User
    public function getBlockedUsers()
    {
        $user_id = auth()->user()->id;

        $blokedUsers = Friends::where('user_id', '=', $user_id)
                        ->where('status', '=', 'blocked')->pluck('friend_id')->toArray();

        return $blokedUsers;    
    }

    // Get Logged in users friends
    public function getFriends()
    {
        $user_id = auth()->user()->id;

        $friends = DB::select(DB::raw("SELECT (CASE WHEN friend_id = ".$user_id ." THEN user_id ELSE friend_id END) AS friends_id FROM friends WHERE (friend_id = ".$user_id." OR user_id = ".$user_id.") AND status ='accepted'"));

        $friendsIds = array();
        foreach ($friends as $friend) {
            $friendsIds[] = $friend->friends_id;
        }
        return $friendsIds;
    }

    // Get Friend Request list
    public function getFriendRequest()
    {
        $user_id = auth()->user()->id;

        $friendRequests = Friends::where('friend_id', '=', $user_id)
                        ->where('status', '=', 'sent')
                        ->pluck('user_id')->toArray();
        return $friendRequests;     
    }

    // Get Sent Friend Request User list
    public function getSentFriendRequest()
    {
        $user_id = auth()->user()->id;

        $friendRequests = Friends::where('user_id', '=', $user_id)
                        ->where('status', '=', 'sent')
                        ->pluck('friend_id')->toArray();
        return $friendRequests;     
    }    

}
