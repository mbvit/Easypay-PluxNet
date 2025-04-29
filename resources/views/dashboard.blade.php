<x-app-layout>
    <div class="flex justify-center items-center w-full flex-col max-w-5xl gap-8 py-6 px-3">
        <livewire:dashboard.greeting-card />

        <!-- <div class="w-full gap-5 grid grid-cols-1 md:grid-cols-2"> -->
        <div class="w-full gap-5 md:flex-row flex-col flex justify-center">
            <livewire:dashboard.customer-details-card /> 

            <livewire:dashboard.easypay-details-card /> 
        </div>
    </div>
</x-app-layout>
