
<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\Customer;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $street= '';
    public string $city= '';
    public string $zip_code = '';
    public string $tariff = '';
    public string $billing_type = '';
    public string $created_at = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;

        $user = Auth::user();
        $customer = Customer::where('email', $user->email)->first();

        $this->phone_number = $customer->phone_number;
        $this->street= $customer->street;
        $this->city= $customer->city;
        $this->zip_code = $customer->zip_code;
        $this->tariff = $customer->tarrif;
        $this->billing_type = $customer->billing_type;
        $this->created_at= $customer->created_at;
        // dump($user->id);
    }

}; ?>

<div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-pluxnet-pink p-4 flex flex-col justify-center items-center">
        <!-- <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/%7B1FBE03EA-24D4-44E8-8F09-B454522EBDC3%7D-zXnnrPKdYwk88hAcoIwN1R00RiCbGT.png" alt="PluxNet Logo" class="h-8"> -->
        <h2 class="text-white text-xl font-bold">Your Portal Details</h2>
        <p class="text-white text-sm ">Check your email for signing into your Portal</p>
    </div>

    <!-- Customer Details -->
    <div class="p-6 space-y-4">
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1">
                <p class="text-sm text-gray-600">Name</p>
                <p class="font-semibold text-pluxnet-navy">{{ $name }}</p>
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600">Name</p>
                <p class="font-semibold text-pluxnet-navy">Doe</p>
            </div>
        </div>

        <div>
            <p class="text-sm text-gray-600">Email Address</p>
            <p class="font-semibold text-pluxnet-navy">{{ $email }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-600">Phone Number</p>
            <p class="font-semibold text-pluxnet-navy">{{ $phone_number }}</p>
        </div>

        <div class="flex flex-col md:flex-row md:space-x-4 w-full">
            <divc class="flex-1">
                <p class="text-sm text-gray-600">Tariff</p>
                <p class="font-semibold text-pluxnet-navy">{{ $tariff }}</p>
            </divc>
            <div class="flex-1">
                <p class="text-sm text-gray-600">Billing Plan</p>
                <p class="font-semibold text-pluxnet-navy">{{ $billing_type}} </p>
            </div>
        </div>

        <div>
            <p class="text-sm text-gray-600">Installation Address</p>
            <p class="font-semibold text-pluxnet-navy">{{ $street }} {{ $city }} {{ $zip_code}} </p>
        </div>
        <!-- <div>
            <p class="text-sm text-gray-600">Account Status</p>
            <p class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-semibold">Active</p>
        </div> -->
    </div>

    <!-- Footer -->
    <div class="bg-gray-100 p-4 flex justify-between items-center">
        <p class="hidden text-sm text-gray-600">Joined: <span class="font-semibold">{{ $created_at }}</span></p>
        <!-- Green more Clickly colour -->
        <button class="w-full bg-pluxnet-coral text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition-colors duration-200">
            Login to Portal
        </button>
    </div>
</div>