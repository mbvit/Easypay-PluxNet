<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SolutionForest\FilamentAccessManagement\Concerns\FilamentUserHelpers;
// use \Request;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use FilamentUserHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Temporary property to hold customer data before saving
    // public array $customerData = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Listening for the Created event
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($user) {
    //         return DB::transaction(function () use ($user) {
    //             if (!$user->save()) {
    //                 return false; // Abort if user creation fails
    //             }

    //             // Ensure we have customer data before proceeding
    //             if (empty($user->customerData)) {
    //                 throw new \Exception("Customer data is missing.");
    //             }

    //             // Create the Customer record
    //             $customer = Customer::create([
    //                 'id' => $user->id,
    //                 'splynx_id' => $user->customerData['splynx_id'],
    //                 'name' => $user->customerData['name'],
    //                 'surname' => $user->customerData['surname'],
    //                 'email' => $user->customerData['email'],
    //                 'phone_number' => $user->customerData['phone_number'],
    //                 'street' => $user->customerData['street'],
    //                 'city' => $user->customerData['city'],
    //                 'zip_code' => $user->customerData['zip_code'],
    //                 'tarrif' => $user->customerData['tarrif'],
    //                 'agreed_terms' => $user->customerData['agreed_terms'],
    //             ]);

    //             if (!$customer) {
    //                 throw new \Exception("Customer creation failed");
    //             }

    //             return true;
    //         });
    //     });
    // }
}
