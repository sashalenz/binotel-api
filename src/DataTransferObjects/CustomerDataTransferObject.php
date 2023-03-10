<?php

namespace Sashalenz\Binotel\DataTransferObjects;

use Illuminate\Support\Collection;

final class CustomerDataTransferObject extends BinotelDataTransferObject
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public ?string $email = null;
    public ?EmployeeDataTransferObject $assignedToEmployee = null;
    public array $numbers = [];
    public ?Collection $labels = null;

    public static function fromArray(array $array): self
    {
        return new self([
            'id' => (int) $array['id'],
            'name' => $array['name'],
            'description' => $array['description'] ?? null,
            'email' => $array['email'] ?? null,
            'assignedToEmployee' => isset($array['assignedToEmployee'])
                ? EmployeeDataTransferObject::fromArray($array['assignedToEmployee'])
                : null,
            'numbers' => $array['numbers'] ?? [],
            'labels' => isset($array['labels'])
                ? LabelDataTransferObject::collectFromArray($array['labels'])
                : null,
        ]);
    }
}
