<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Status</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)    
                
                @php
                  $status = $order->status;
                  if($status == 'new'){
                    $status = 'bg-blue-500';
                  }elseif($status == 'processing'){
                    $status = 'bg-orange-500';
                  }elseif($status == 'shipped'){
                    $status = 'bg-green-500';
                  }elseif($status == 'delivered'){
                    $status = 'bg-green-700';
                  }elseif($status == 'cancelled'){
                    $status = 'bg-red-500';
                  }

                  $payment_status = $order->payment_status;
                 
                  if($payment_status == 'pending'){
                    $payment_status = 'bg-yellow-500';
                  }elseif($payment_status == 'paid'){
                    $payment_status = 'bg-green-500';
                  }elseif($payment_status == 'failed'){
                    $payment_status = 'bg-red-500';
                  }
                @endphp 
                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $order->id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $order->created_at->format('d-m-Y') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><span class="{{$status}} py-1 px-3 rounded text-white shadow">{{ucfirst($order->status)}}</span></td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"><span class="{{$payment_status}} py-1 px-3 rounded text-white shadow">{{ucfirst($order->payment_status)}}</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ Number::currency($order->grand_total, 'INR') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <a href="/my-order/{{$order->id}}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a>
                  </td>
                </tr>
                @endforeach
           
  
              </tbody>
            </table>
          </div>
        </div>
        {{ $orders->links() }}
      </div>
    </div>
  </div>