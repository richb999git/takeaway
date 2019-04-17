<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //cast text field into an array (stored as json?). Not sure if this works yet
    protected $casts = [
        'p_order' => 'array'
    ];

    public static function acceptOrder($fname, $lname, $phone, $email, $address1, $address2, $address3, $address4, $delivery, $cart) {
        $order = new \App\Order;
        $order->p_order = json_encode($cart);
        $order->first_name = $fname;
        $order->last_name = $lname;
        $order->phone = $phone;
        $order->email = $email;

        if ($delivery == "Y") {
            $order->delivery = $delivery;
            $order->address1 = $address1;
            $order->address2 = $address2;
            $order->address3 = $address3;
            $order->address4 = $address4;
        } else {
            $order->delivery = "N";
        }

        $order->status = "Received";
        $order->paid = "N";
        $order->receivedDateTime = date("Y-m-d H:i:s"); // today as default 

        if(!$order->save()) {
            //App::abort(500, 'Error saving order');
            session()->flash('errorMessage', 'Error saving order');
            return redirect()->route('placeOrder');
        };
        return $order;
    }

    public static function paidByCard($id, $ref) {
        $order = Order::findOrFail($id);
        $order->paid = "Y";
        $order->cardPaymentRef = $ref;
        $order->save();
    }

    
    //-----------------------------------------ADMIN METHODS--------------------------------------

    // admin method
    public static function changeOrderPaymentStatus($id, $paidYN) {
        $order = Order::findOrFail($id);
        $order->paid = $paidYN;
        $order->save();
    }
 
    // admin method
    public static function changeOrderStatus ($id, $status) 
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
    }

    // admin method
    public static function getUnpaidOrder($name) {
        if ($name) {
            $orders = Order::where(function ($query) use ($name) {
                $query->where('first_name', $name)
                    ->orWhere('last_name', $name);
                })
                ->where(function ($query) {
                    $query->where('paid', 'N');
                })
                ->get();
        } else {
            $orders = Order::where('paid', 'N')->get();
        }
        return $orders;               
        // same as SELECT * FROM <table> WHERE (name='foo' or name='bar') AND (paid='N');  
    }

    // admin method
    public static function getCurrentOrdersByName($name) {
        if ($name) {
            $orders = Order::where(function ($query) use ($name) {
                $query->where('first_name', $name)
                    ->orWhere('last_name', $name);
                })
                ->where(function ($query) {
                    $query->where('status', 'Received')
                        ->orWhere('status', 'Cooking');
                })
                ->get();
        } else {
            $orders = Order::where('status', "Received")->orWhere('status', "Cooking")->get();
        }
        return $orders;  
        // same as SELECT * FROM <table> WHERE (name='foo' or name='bar') AND (status='Cooking' or status='Received');
    }


}
