<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
#use App\Traits\HasRoleAndPermission;
use TCG\Voyager\Models\Role;

class User extends \TCG\Voyager\Models\User
{
    #use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    protected $dates = [
        'deleted_at',
    ];


    public function isAdmin()
    {
      if($this->role->name == 'admin')
        return true;
      else
        return false;
    }


    /**
     * Build Social Relationships.
     *
     * @var array
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    /**
     * User Profile Relationships.
     *
     * @var array
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name == $name) {
                return true;
            }
        }

        return false;
    }


    public function mask_email( $email ) {
        /*
        Author: Fed
        Simple way of masking emails
        */
        
        $char_shown = 1;
        
        $mail_parts = explode("@", $email);
        $username = $mail_parts[0];
        $len = strlen( $username );
        
        if( $len <= $char_shown ){
            return implode("@", $mail_parts );  
        }
        
        //Logic: show asterisk in middle, but also show the last character before @
        $mail_parts[0] = substr( $username, 0 , $char_shown )
            . str_repeat("*", $len - $char_shown - 1 )
            . substr( $username, $len - $char_shown + 2 , 1  )
            ;
            
        return implode("@", $mail_parts );
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }
}
