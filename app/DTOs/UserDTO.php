<?php

namespace App\DTOs;

use JsonSerializable;
use DateTime;

class UserDTO implements JsonSerializable
{
    public string $id;
    public string $name;
    public string $email;
    public ?\DateTime $email_verified_at;
    public string $password;
    public string $role_id;
    public ?string $is_mobile_app;
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
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'role_id' => $this->role_id,
            'is_mobile_app' => $this->is_mobile_app,
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