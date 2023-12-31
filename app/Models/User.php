<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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

    public function getUsuariosPesquisarIndex(string $pesquisar = '')
    {
        //Pesquisando com filtro na tabela
        //caso nao encontrar a pesquisa retorna vazio
        $usuario = $this->where( function ($query) use ($pesquisar){
            if($pesquisar){
                $query->where('name' ,$pesquisar);
                $query->orWhere('name', 'LIKE' , "%{$pesquisar}%");
                $query->orWhere('email', 'LIKE' , "%{$pesquisar}%");
            }
        })->get();

        return $usuario ;

    }
}
