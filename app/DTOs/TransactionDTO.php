<?php

namespace App\DTOs;

use JsonSerializable;
use DateTime;

class TransactionDTO implements JsonSerializable
{
    public string $id;
    public string $code;
    public string $user_id;
    public string $donation_type_id;
    public ?string $snap_token;
    public ?string $receipt_payment;
    public ?float $total_payment;
    public string $payment_method;
    public string $status;
    public \DateTime $payment_date;
    public ?\DateTime $created_at;
    public ?\DateTime $updated_at;

    public function __construct(
        array $data = []
    ) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($value instanceof DateTime || (is_string($value) && strtotime($value))) {
                    $this->$key = $value instanceof DateTime ? $value : new DateTime($value);
                } else {
                    $this->$key = $value;
                }
            }
        }
    }

    public function toArray(): array
    {
        $array = [
            'id' => $this->id,
            'code' => $this->code,
            'user_id' => $this->user_id,
            'donation_type' => $this->donation_type_id,
            'snap_token' => $this->snap_token,
            'receipt_payment' => $this->receipt_payment,
            'total_payment' => $this->total_payment,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'payment_date' => $this->payment_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];

        // Convert DateTime objects to strings
        foreach ($array as $key => $value) {
            if ($value instanceof DateTime) {
                $array[$key] = $value->format('Y-m-d H:i:s');
            }
        }

        return $array;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}