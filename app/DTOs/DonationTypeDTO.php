<?php

namespace App\DTOs;

use JsonSerializable;
use DateTime;

class DonationTypeDTO implements JsonSerializable
{
    public string $id;
    public ?string $photo;
    public string $name;
    public ?string $description;
    public bool $is_active;
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
            'photo' => $this->photo,
            'name' => $this->name,
            'is_active' => $this->is_active,
            'description' => $this->description,
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