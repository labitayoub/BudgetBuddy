<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'devise', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function expenses()
    {
        return $this->belongsToMany(Expense::class, 'expense_group');
    }
    
}
