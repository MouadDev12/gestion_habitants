<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory; // ← IMPORTANT

    protected $fillable = ['ville', 'nombreHabitant'];

    public function habitants()
    {
        return $this->hasMany(Habitant::class);
    }
}