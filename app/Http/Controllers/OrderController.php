<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\Ticket;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function place_order(Request $request, FlasherInterface $flasher) {

         //get form datas
         $fullname = $request->input('first_name') . ' ' . $request->input('last_name');
         $email = $request->input('email');
         $address = $request->input('address');
         $phone = $request->input('phone');

         $event_id = $request->input('event_id');
         $event_name = $request->input('event_name');
         $event_price = $request->input('event_price');


         // prepare rave request
$order = [
    'tx_ref' => time(),
    'amount' =>  $event_price,
    'currency' => 'NGN',
    'payment_options' => 'card',
    'redirect_url' => url('/process'),
    'customer' => [
        'name' =>  $fullname,
        'phone' => $phone,
        'email' => $email,
    ],
    'meta' => [
        'price' => $event_price,
       'name' => $fullname,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'event_id' =>  $event_id,
        'event_name' =>  $event_name,
    ],
    'customazations' => [
        'title' => 'Paying for a event',
        'description' => 'sample'
    ]
];

    // call the flutterwave endpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($order),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer FLWSECK_TEST-2ad263c5810b12aa4c2af88aba3e581a-X',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $res = json_decode($response);

    if($res->status == 'success') {
        $link = $res->data->link;
        header('Location: '.$link);
        exit();
    } else {

        flash()
        ->options([
            'timeout' => 3000, // 3 seconds
            'position' => 'top-right',
        ])->addError('Your payment cannot be processed');
        return back();
    }

}

    // process payment
    public function process() {

        if ($_GET['status'] == 'cancelled')
        {
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-right',
            ])->addError('Your payment was concelled');
            return back();
            exit();
        } else {
            $txid = $_GET['transaction_id'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer FLWSECK_TEST-2ad263c5810b12aa4c2af88aba3e581a-X"
              ),
            ));
            $response =  curl_exec($curl);
            curl_close($curl);

            $res = json_decode($response);

            //order data
            $order = $res->data->meta;

            // instantiaite order model
            $orders = new Order;

            $orders->event_id = $order->event_id;
            $orders->attendee_name = $order->name;
            $orders->attendee_email = $order->email;
            $orders->attendee_phone = $order->phone;
            $orders->attendee_address = $order->address;
            $orders->order_price = $order->price;
            //getting the first two letters from name
            $subname = substr($order->name, 0, 3);
            $ticket = strtoupper($subname.'-'.$order->event_id.'-'.Str::random(6));

            $orders->ticket_number =$ticket;

            $orders->save();

            flash()
            ->option('position', 'top-right')
            ->option('timeout', 3000)
            ->addSuccess('Your purchase was successful');

            //email user ticket details
            $order = Order::where('id', 1)->first();
            $qr_code = QrCode::generate($order->ticket_number);

            $data = [
            'subject' => 'YOUR TICKET INFORMATION',
            'body' => 'We are happy to have you attend this events',
            'ticket' => $order->ticket_number,
            'qr_code' => $qr_code,
            'price' => $order->order_price,
            'name' => $order->attendee_name
            ];

            Mail::to('hello@example.com')->send(new Ticket($data));

            return to_route('home');

        }


    }

}
