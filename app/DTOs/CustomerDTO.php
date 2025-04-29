<?php

namespace App\DTO;

class CustomerDTO
{
    public function __construct(
        public string $login,
        public string $status,
        public int $partner_id,
        public int $location_id,
        public string $password,
        public string $name,
        public string $email,
        public string $billing_email,
        public string $phone,
        public string $category,
        public string $street_1,
        public string $zip_code,
        public string $city,
        public string $date_add,
        public string $gps,
        public float $mrr_total,
        public string $billing_type,
        public string $added_by,
        public int $added_by_id,
        public string $last_online,
        public string $last_update,
        public float $daily_prepaid_cost,
        public array $customer_labels
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['login'] ?? '',
            $data['status'] ?? '',
            $data['partner_id'] ?? 0,
            $data['location_id'] ?? 0,
            $data['password'] ?? '',
            $data['name'] ?? '',
            $data['email'] ?? '',
            $data['billing_email'] ?? '',
            $data['phone'] ?? '',
            $data['category'] ?? '',
            $data['street_1'] ?? '',
            $data['zip_code'] ?? '',
            $data['city'] ?? '',
            $data['date_add'] ?? '',
            $data['gps'] ?? '',
            $data['mrr_total'] ?? 0.0,
            $data['billing_type'] ?? '',
            $data['added_by'] ?? '',
            $data['added_by_id'] ?? 0,
            $data['last_online'] ?? '',
            $data['last_update'] ?? '',
            $data['daily_prepaid_cost'] ?? 0.0,
            $data['customer_labels'] ?? []
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
