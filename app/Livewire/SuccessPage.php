<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;

#[Title('Order Placed Successfully')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();

        if ($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $session_info = Session::retrieve($this->session_id);
            if ($session_info->payment_status != 'paid') {
                $latest_order->update(['payment_status' => 'failed']);
                return redirect()->to('/my-orders');
            } else {
                $latest_order->update(['payment_status' => 'paid']);
            }
        }
        return view('livewire.success-page', [
            'order' => $latest_order
        ]);
    }
}
