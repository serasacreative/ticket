<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Ticket::class, 'order_id', 'id');
    }
}
