<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function shortUrls()
    {
        return $this->hasMany(ShortUrl::class);
    }

    public function receivedInvitations()
    {
        return $this->hasMany(Invitation::class, 'email', 'email');
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function hasAnyRole($roles)
    {
        return in_array($this->role, (array)$roles);
    }

    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'SuperAdmin';
    }

    public function isMember()
    {
        return $this->role === 'Member';
    }
}
