<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    use HasRolesAndAbilities;

    public function isAdmin()
    {
        return $this->isAn('admin');
    }

    public function isManager()
    {
        return $this->isAn('manager');
    }

    public function isUser()
    {
        return $this->isAn('user');
    }

    // Metod za kreiranje novog admina
    public static function createAdmin($data)
    {
        // Provera da li već postoji admin u bazi
        if (static::where('admin', true)->exists()) {
            // Već postoji admin, ne dozvoli kreiranje novog admina
            return null;
        }

        // Kreiranje novog admina
        return static::create(array_merge($data, ['admin' => true]));
    }
}
