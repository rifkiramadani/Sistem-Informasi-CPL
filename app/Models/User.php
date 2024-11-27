<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Operator;
use App\Models\Mahasiswa;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'username',
        'name',
        'email',
        'password',
        'profile_picture'
    ];

    public function admins() {
        return $this->HasMany(Admin::class);
    }

    public function operators() {
        return $this->HasMany(Operator::class);
    }

    public function dosens() {
        return $this->HasMany(Dosen::class);
    }

    public function mahasiswas() {
        return $this->HasMany(Mahasiswa::class);
    }

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
}
