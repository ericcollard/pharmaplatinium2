<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'avatar_path',
        'adress',
        'postal_code',
        'city',
        'phone',
        'last_login',
        'comment',
        'email_verified_at'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'roles' => 'array',
    ];


    public function brands()
    {
        return $this->hasMany(Brand::class,'manager_id');
    }

    /* -- Roles function -- */

    /***
     * @param string $role
     * @return User
     */
    public function addRole(string $role): User
    {
        $roles = $this->getRoles();
        $roles[] = $role;

        $roles = array_unique($roles);
        $this->setRoles($roles);

        return $this;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): User
    {
        $this->setAttribute('roles', $roles);
        return $this;
    }

    /***
     * @param $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        return in_array($role, $this->getRoles());
    }

    /***
     * @param $roles
     * @return bool
     */

    public function hasRoles($roles): bool
    {

        $currentRoles = $this->getRoles();
        foreach($roles as $role) {
            if ( ! in_array($role, $currentRoles )) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->getAttribute('roles');
        if (is_null($roles)) {
            $roles = [];
        }

        return $roles;
    }

    public function avatarUrl(): string
    {
        return $this->avatar_path ? Storage::disk('avatars')->url($this->avatar_path) : asset('assets/images/users/default.png');
    }

    // Only accept a valid password and
    // hash a password before saving
    public function setPasswordAttribute($password)
    {
        if ( $password !== null & $password !== "" )
        {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function path()
    {
        return route('user.show', $this);
    }


}
