<?php

namespace App\Models;

<<<<<<< HEAD
=======
// use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
<<<<<<< HEAD
    use HasFactory, Notifiable;

=======
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
        'role',
    ];

=======
        "role",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< HEAD
=======
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> b336feec924672af61f2f862ed61714546fd3112
