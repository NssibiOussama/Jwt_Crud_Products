<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     required={"name", "email", "password"},
 *     @OA\Property(
 *         property="id",
 *         description="ID unique de l'utilisateur",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         description="Nom de l'utilisateur",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         description="Email de l'utilisateur",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         description="Mot de passe de l'utilisateur",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         description="Date de création de l'utilisateur",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         description="Date de mise à jour de l'utilisateur",
 *         type="string",
 *         format="date-time"
 *     )
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
