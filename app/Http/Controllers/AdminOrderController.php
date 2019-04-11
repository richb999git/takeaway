<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Services\CsvServices;

class AdminOrderController extends Controller
{
    public function showCurrentOrdersByName()
    {
        $orders = Order::getCurrentOrdersByName(request()->name);    
        return view('admin.showCurrentOrders', ['orders' => $orders] );
    }

    public function showUnpaidOrders()
    {
        $orders = Order::getUnpaidOrder(request()->name);      
        return view('admin.showUnpaidOrders', ['orders' => $orders] );
    }

    public function changePaymentStatusToPaid ($id) 
    {
        Order::changeOrderPaymentStatus($id, "Y");
        return redirect(url()->previous() . '#order' . $id);
    }

    public function changePaymentStatusToUnpaid ($id) 
    {
        Order::changeOrderPaymentStatus($id, "N");
        return redirect(url()->previous() . '#order' . $id);
    }

    public function changeOrderStatusToRecd ($id) 
    {
        Order::changeOrderStatus($id, "Received");
        return redirect(url()->previous() . '#order' . $id);
    }

    public function changeOrderStatusToCooking ($id) 
    {
        Order::changeOrderStatus($id, "Cooking");
        return redirect(url()->previous() . '#order' . $id);
    }

    public function changeOrderStatusToDelivered ($id) 
    {
        Order::changeOrderStatus($id, "Delivered");
        return redirect(url()->previous() . '#order' . $id);
    }

    public function changeOrderStatusToCollected ($id) 
    {
        Order::changeOrderStatus($id, "Collected");
        return redirect(url()->previous() . '#order' . $id);
    }

    public function changeOrderStatusToCancelled ($id) 
    {
        Order::changeOrderStatus($id, "Cancelled");
        return redirect(url()->previous() . '#order' . $id);
    }


    public function downloadOrders() {
        $rows = Order::all('id', 'p_order', 'first_name', 'last_name', 'email', 'phone', 'delivery', 'address1', 'address2', 'address3', 'address4', 'paid', 'receivedDateTime');
        $rows = json_decode(json_encode($rows), true);
        $columnNames = ['id', 'p_order', 'first_name', 'last_name', 'email', 'phone', 'delivery', 'address1', 'address2', 'address3', 'address4', 'paid', 'receivedDateTime' ];
        return CsvServices::getCsv($columnNames, $rows, 'orders.csv');
    }

}
