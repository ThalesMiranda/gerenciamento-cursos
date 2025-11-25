<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'area_especializacao'];

    public function turmas(): HasMany
    {
        return $this->hasMany(Turma::class);
    }
}
