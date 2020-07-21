<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        if($request->a == 1){
            return User::all();
        }
        return User::orderBy('id', 'desc')->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[ 
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8',
            'type' => 'required'

        ]);
        return User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'type'=>$request->type
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[ 
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'type' => 'required'

        ]);

        $user = User::find($id);
        $user->update($request->all());
        return['message'=>'Successfull'];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return ['message'=>'User Deleted'];
    }

    public function search()
    {
        if ($search = \Request::get('q')){
            if(preg_match('(2020|2021)', $search) > 0){
                $users = User::where(function($query) use ($search){
                    $query->where('created_at','LIKE',"%".Carbon::parse($search)->format('Y-m-d')."%");
                })->paginate(5);
                return $users;
            }
            else{
                $users = User::where(function($query) use ($search){
                    $query->where('id','LIKE',"%$search%")->orWhere('name','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('type','LIKE',"%$search%");
                })->paginate(5);
                return $users;
            }
        }
        else{
            return User::orderBy('id', 'desc')->paginate(5);
        }
    }

    public function chart_data()
    {
        $users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, type'))
                     ->groupBy('type')
                     ->get();
        return $users;
    }

    public function get_user_name(Request $request)
    {
        return $request->user('api');
    }

    public function get_number()
    {
        return ['messages_limit'=>1410,'bookmarks_limit'=>410,'uploads_limit'=>13648,'likes_limit'=>93139];
    }
    
}