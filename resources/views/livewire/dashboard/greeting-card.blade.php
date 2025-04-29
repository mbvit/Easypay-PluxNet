
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
    public string $created_at = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;

        $user = Auth::user();
        // $customer = Customer::where('email', $user->email)->first();

    }

}; ?>

<div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Greeting Content -->
    <div class="bg-gradient-to-r from-pluxnet-pink to-pluxnet-coral p-3 text-center">
        <h2 class="text-white text-3xl font-bold mb-4">Welcome to PluxNet!</h2>
        <p class="text-white text-opacity-90 text-lg">
            We're thrilled to have you on board. Get ready to experience internet at the speed of light!
        </p>
    </div>

    <!-- Footer -->
    <!-- <div class="bg-white p-6 text-center">
        <p class="text-pluxnet-navy text-lg mb-4">
            Your journey to lightning-fast internet starts here.
        </p>
        <a href="#" class="inline-block bg-pluxnet-coral text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-opacity-90 transition-colors duration-200">
            Explore Your Dashboard
        </a>
    </div> -->
</div>