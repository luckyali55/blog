<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bouncer;

class UsersController extends BaseController
{

    private $user;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(!isAdmin())
                abort(401);

            return $next($request);
        });
        $this->user = new User();

    }

    public function index(){

        $users = $this->user->getUsers();

        return view('users.list', ['users' => $users]);
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $role = $request->only('role');
        $input      =   $request->only('name', 'email', 'password');
        $user = $this->user->addUser($input);
        $this->user->assignRole($user, $role['role']);
        return redirect(route('users'));

    }

    public function edit($id){
        $user = $this->user->getUserById($id);
        $abilities = $user->getAbilities()->toArray();
        $user_abilities = [];
        foreach ($abilities as $ability){
            $m_exp = explode("\\", $ability['entity_type']);
            $mod = end($m_exp);
            $user_abilities[$mod][] = $ability['name'];
        }

        return view('users.edit', ['user' => $user, 'id' => $id, 'abilities' => $user_abilities]);
    }

    public function update(Request $request, $id){
        $input = $request->only('role', 'name', 'email', 'password', 'password_confirmation');
        $abilities = $request->except('role','_token', 'name', 'email', 'password', 'password_confirmation');

        if(is_null($input['password'])){
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'required|confirmed',
            ]);
        }

        $save = $this->user->updateUser($input, $abilities, $id);
        if(false === $save){
            return redirect()->back()->with(['db_error' => 'Error occurred, please try again ']);
        }else{
            return redirect(route('users'));
        }
    }


}
