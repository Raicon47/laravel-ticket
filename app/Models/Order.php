<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
       'event_id',
       'attendee_name',
       'attendee_email',
       'attendee_phone',
       'attendee_address',
       'order_price',
       'ticket_number',
       'qr_code',
    ];

    protected $table = 'orders';
}
