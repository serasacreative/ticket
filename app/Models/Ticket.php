<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public function email_data()
    {
        return $this->hasOne(Email::class, 'order_id', 'id');
    }

}
