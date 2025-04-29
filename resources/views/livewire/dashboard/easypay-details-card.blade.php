
<?php

use App\Livewire\Actions\Logout;
use App\Models\EasyPay;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public bool $isDebit = false;
    public string $easypay_number = '';
    
    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $customer = Customer::where('email', $user->email)->first();
        
        if ($customer->billing_type === "debit") {
            $this->isDebit = true;
            $easyPay = EasyPay::where('splynx_id', $customer->splynx_id)->first();
            $this->easypay_number = $easyPay->easypay_number;
        }

        return;
    }

}; ?>


<div class={{"max-w-7xl mx-auto sm:px-6 lg:px-8 w-full" . $isDebit ? '' : 'hidden'}}>
    @if ($isDebit)
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-pluxnet-pink p-4 flex flex-col justify-center items-center">
                <!-- <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/%7B1FBE03EA-24D4-44E8-8F09-B454522EBDC3%7D-zXnnrPKdYwk88hAcoIwN1R00RiCbGT.png" alt="PluxNet Logo" class="h-8"> -->
                <h2 class="text-white text-xl font-bold">EasyPay</h2>
                <p class="text-white text-xs ">Use this for all Payment Refrences</p>
            </div>

            <!-- Customer Details -->
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-gray-600">EasyPay Number</p>
                    <p class="text-lg font-semibold text-pluxnet-navy">
                        {{ implode(' ', str_split($easypay_number, 4)) }} (Group of 4)
                    </p>
                    <p class="text-sm text-gray-600">Always use your EasyPay number as Payment Refrence</p>
                </div>
                <p class="text-gray-600">Your EasyPay number can be used at all local stores, Shoprites
                    taxi ranks.
                </p>
            </div>

            <!-- Footer -->
            <div class="bg-gray-100 p-4 flex justify-between items-center">
                <button onclick="copyToClipboard('EasyPay Number', '{{ $easypay_number}}')" class="bg-pluxnet-coral text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition-colors duration-200">
                    Copy EasyPay Number
                </button>
            </div>
        </div>
    @endif
</div>