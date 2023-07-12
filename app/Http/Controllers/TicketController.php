<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    public function homepage() {
        $tickets = Event::orderBy('created_at', 'DESC')->get();
        $orders = Order::all();


        return view('welcome', compact('tickets', 'orders'));
        // return view('welcome')->with('tickets', $tickets);
    }

    public function ticket($name) {
        $event = Event::where('name', $name)->first();

        return view('event')->with('event', $event);
    }

}
