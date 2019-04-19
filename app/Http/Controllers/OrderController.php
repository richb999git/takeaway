<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\TakeawayMenu;
use Session;
use App\Http\Controllers\App;
use App\Mail\OrderReceived;
use App\Mail\CardPaymentReceived;
use App\Services\OpeningTimes;

class OrderController extends Controller
{
    public function addCartItem($id)
    {
        // order in session 
        $addedItem = TakeawayMenu::find($id);
        $oldCart = Session::has('cart2') ? session('cart2') : [];
        $addedArray = ['title' => $addedItem->title, 'price' => $addedItem->price];
        array_push($oldCart, $addedArray);
        Session::put('cart2', $oldCart);
        return redirect(url()->previous() . '#cartDisplay');
    }

    public function deleteCartItem($id)
    {
        $oldCart = session('cart2');
        array_splice($oldCart, $id, 1);
        Session::put('cart2', $oldCart);
        return redirect()->route('menu');
    }

    public function placeOrder()
    {
        $time = OpeningTimes::OpeningTimes();
        
        if(date("l") == $time['day_closed']) {
            session()->flash('errorMessage', "Sorry, we are closed today. We open again tomorrow at 5pm");
        }

        if ($time['current_time'] < $time['opening']) {
            session()->flash('errorMessage', "We are presently closed. We open at 5pm. We will accept your order and it will be ready at opening time.");
        }

        if ($time['current_time'] > $time['closing']) {
            session()->flash('errorMessage', "Sorry, we closed at 11:30pm");
        }

        return view('placeOrder');
    }

    public function acceptOrder()
    {

        $time = OpeningTimes::OpeningTimes();

        if(date("l") == $time['day_closed']) {
            session()->flash('errorMessage', "Sorry, we are closed today. We open again tomorrow at 5pm");
            return redirect()->route('placeOrder'); 
        }

        $early_order = false;
        if ($time['current_time'] < $time['opening']) {
            //session()->flash('errorMessage', "Sorry, we are presently closed. We open at 5pm.");
            $early_order = true; 
        }
        
        if ($time['current_time'] > $time['closing']) {
            session()->flash('errorMessage', "Sorry, we closed at 11:30pm");
            return redirect()->route('placeOrder'); 
        }

        request()->validate([
            'first_name' => ['required', 'min:2', 'max:190'],
            'last_name' => ['required', 'min:2', 'max:190'],
            'phone' => ['required', 'digits_between:6,11', 'numeric']   
        ]);

        if (request('email') != "") {
            request()->validate([
            'email' => 'email'
            ]);
        }
        
        if (request('delivery') == "Y") {
            request()->validate([
                'address_1' => 'required',
                'address_2' => 'required'
                ]);
        } 

        $delivery = request('delivery');
        if ($time['current_time'] > $time['last_delivery'] && $delivery == "Y") {
            session()->flash('errorMessage', "Sorry, last order taken for delivery is 10:30pm");
            return redirect()->route('placeOrder'); 
        }

        if ($time['current_time'] > $time['last_collection'] && $delivery == "N") {
            session()->flash('errorMessage', "Sorry, last order taken for collection is 11:15pm");
            return redirect()->route('placeOrder'); 
        }

        $cart = session('cart2');
        $order = Order::acceptOrder(
            request('first_name'),
            request('last_name'),
            request('phone'),
            request('email'),
            request('address_1'),
            request('address_2'),
            request('address_3'),
            request('address_4'),
            request('delivery'),
            $cart
        );
        Session::put('orderID', $order->id);
        Session::put('orderEmail', $order->email);
        

        if ($order->email != "") {
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            \Mail::to(request('email'))->send(
                new OrderReceived($order)
            );
            
        }

        session()->flash('cartOrdered', $cart);

        if ($order->email != "") {
            session()->flash('message', "Thank you for your order! Order number: " . $order->id . ". We have sent you an email confirmation.");
        } else {
            session()->flash('message', "Thank you for your order! Order: " . $order->id);
        }

        if ($order->delivery == "Y") {
            if ($early_order) {
                session()->flash('message2', "We will deliver your order by 1 hour after opening."); 
            } else {
                session()->flash('message2', "Normally it will be delivered within 1 hour."); 
            }
        } else {
            if ($early_order) {
                session()->flash('message2', "Your order will be ready at opening time.");
            } else {
                session()->flash('message2', "Your order will be ready to collect in 15 minutes.");
            }
            
        } 
               
        session()->forget('cart2');
        session()->forget('cartTotal');

        return redirect()->route('placeOrder'); 
    }


    
    public function cardPayment() {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_e5sttrrSfJ6ZBzOrtveERach00tLCCztBM");
        //dd('before charge');
        session()->flash('message2', "");
        try {
            $charge = \Stripe\Charge::create([
                'amount' => request('amount'),
                'currency' => 'gbp',
                'description' => 'Bengal Tiger takeaway ' . session('orderID'),
                'source' => request('stripeToken'),
                'metadata' => ['order_id' => session('orderID')],  // to do properly
            ]);
        } catch(\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err  = $body['error'];
            dump('Status is:' . $e->getHttpStatus() . "\n");
            dump('Type is:' . $err['type'] . "\n");
            dump('Code is:' . $err['code'] . "\n");
            dd('Message is:' . $err['message'] . "\n");
            session()->flash('message', $err['message'] . ". Please phone us or pop in.");
        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            session()->flash('message', "Payment problem. Please phone us or pop in.");
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            session()->flash('message', "Payment problem. Please phone us or pop in.");
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed (maybe you changed API keys recently)
            session()->flash('message', "Payment problem. Please phone us or pop in.");
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            session()->flash('message', "Payment problem. Please phone us or pop in.");
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send yourself an email
            session()->flash('message', "Payment problem. Please phone us or pop in.");
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            session()->flash('message', "Payment problem. Please phone us or pop in.");
        }
        
        if (isset($charge->paid)) {            
            Order::paidByCard(session('orderID'), $charge->payment_method);
            \Mail::to(session('orderEmail'))->send(
                new CardPaymentReceived(session('orderID'), $charge->payment_method)
            );
            session()->flash('message', "Your payment has been successful. We have just sent you an email to confirm.");
            session()->flash('message2', "Payment reference: ". $charge->payment_method);
        } else {
            session()->flash('message', "Payment declined. Please phone us or pop in.");
            session()->flash('message2', "");
        }

        session()->forget('orderID');
        session()->forget('orderEMail');
        
        return redirect()->route('placeOrder'); 
    }

    public function paymentRequest() {
        return view('paymentRequest');
    }

}
