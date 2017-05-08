<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Bouncer;
use DB;



class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function articles(){
        return $this->hasMany('App\Article');
    }




    public function getUsers(){
        return User::all();
    }

    public function getUserById($id){
        return User::findOrFail($id);
    }


    public function addUser($data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt(trim($data['password'])),
        ]);
    }

    public function assignRole($user, $role){
        if(is_numeric($user)){
            $userDB = User::find($user);
            $this->retractRole($userDB, $role) ;
            Bouncer::assign($role)->to($userDB);
        }else{
            $this->retractRole($user, $role);
            Bouncer::assign($role)->to($user);
        }
    }

    public function updateUser($data, $abilities, $id){

        if($data['password'] == '')
        {
            User::where('id', $id)->update(['name' => $data['name'], 'email' => $data['email']]);
        }else{
            User::where('id', $id)->update(['name' => $data['name'], 'email' => $data['email'], 'password' => bcrypt($data['password'])]);
        }

        $this->assignRole($id, $data['role']) ;
        $this->manageAbilities($id, $data['role'], $abilities);
    }


    public function actAs($user, $role){
        if (ctype_alpha($role) && preg_match('/^[aeiou]/i', $role)){
            return $user->isAn($role);
        }else{
            return $user->isA($role);
        }
    }


    public function retractRole($user, $new_role){
        $user->retract('user');
        $user->retract('admin');
       /* switch ($new_role){
            case 'admin':
                return $user->retract('user');
                break;
            case 'user':
                return $user->retract('admin');
                break;
            default:
                 return true;
        }*/
    }

    public function manageAbilities($userID, $role, $abilities){
        $user = User::find($userID);
        $this->removeAbilities($userID) ;
        switch ($role){
            case 'admin':
                Bouncer::allow($user)->everything();
                break;
            case 'user':
                   foreach($abilities as $model => $options){
                           foreach ($options as $option){
                               Bouncer::allow($user)->to($option, "App\\$model");
                           }
                   }
                break;
            default:
                return true;
        }

    }


    public function removeAbilities($user){
        return DB::delete('delete from abilities  where id in (select ability_id from permissions where entity_id = '.$user.')');
    }




}
