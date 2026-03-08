<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitant extends Model
{
    use HasFactory; // ← IMPORTANT

    protected $fillable = ['cin', 'nom', 'prenom', 'photo', 'ville_id'];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}