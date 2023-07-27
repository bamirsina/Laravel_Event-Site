<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'number',
        'age',
        'people',
        'zone',
        'zone-price',
        'total-price',
        'ticket_code',
        'status',
        'is_approved',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

//    public function appapprovedrove()
//    {
//        $this->update(['status' => 'approved']);
//    }
//
//    public function disapprove()
//    {
//        $this->update(['status', 'disapprove']);
//    }
//
//    public function pending()
//    {
//        $this->update(['status', 'pending']);
//    }
}
