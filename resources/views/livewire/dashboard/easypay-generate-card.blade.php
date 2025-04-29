
<?php

use App\Livewire\Actions\Logout;
use App\Models\EasyPay;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Services\EasyPayService;

new class extends Component
{
    public string $customerId = '';
    public bool $showEP_number= false;
    public string $easypay_number = '';
    
    /**
     * Mount the component.
     */
    public function generate(): void
    {
        $easypayService = new EasyPayService();
        $this->easypay_number = $easypayService->generate($this->customerId);
        $this->showEP_number = true;
        // dump($user->id);
    }

}; ?>
<div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden text-slate-950">
    <div class="bg-pluxnet-pink p-6">
        <h2 class="text-white text-xl font-bold">Get your EasyPay Number</h2>
    </div>

    <div class="p-6 space-y-6">
        <form wire:submit="generate" class="space-y-6">
            <div class="flex flex-col justify-center items-start" >
                <x-input-label class="text-3xl font-bold" for="customerId" :value="__('Enter your Customer ID')" />
                <x-text-input wire:model="customerId" id="customerId" class="block mt-1 w-full" type="text" name="customerId" required autofocus autocomplete="customerId" />
                <x-input-error :messages="$errors->get('customerId')" class="mt-2" />
                <x-input-label class="text-3xl" for="customerId" :value="__('Your ID can be found on your PluxNet invoices')" />
            </div>

            <x-primary-button class="ms-4 text-3xl">
                {{ __('Generate EasyPay Number') }}
            </x-primary-button>
        </form>

        @if ($showEP_number)
            <div id="resultCard" class="bg-white border-2 border-pluxnet-pink rounded-lg p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-600">Your EasyPay Number</p>
                    <p id="easyPayNumber" class="font-mono text-2xl font-bold text-pluxnet-navy">
                        {{ implode(' ', str_split($easypay_number, 4)) }}
                    </p>
                    <button onclick="copyToClipboard('EasyPay Number', '{{ $easypay_number}}')" class="bg-pluxnet-coral text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition-colors duration-200">
                        Copy EasyPay Number
                    </button>
                </div>
                <p class="text-sm text-gray-600">Use this number to make quick and easy payments for your PluxNet services.</p>
            </div>
        @endif
    </div>
</div>