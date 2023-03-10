<?php

namespace Sashalenz\Binotel\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Binotel\DataTransferObjects\CustomerDataTransferObject;
use Sashalenz\Binotel\DataTransferObjects\LabelDataTransferObject;
use Sashalenz\Binotel\Exceptions\BinotelException;

final class Customers extends BaseModel
{
    protected string $model = 'customers';

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function list(): Collection
    {
        return CustomerDataTransferObject::collectFromArray(
            $this->method('list')
                ->request()
                ->get('customerData')
        );
    }

    /**
     * @param int|array $id
     * @return Collection
     * @throws BinotelException
     */
    public function takeById(int | array $id): Collection
    {
        return CustomerDataTransferObject::collectFromArray(
            $this->method('take-by-id')
                ->params([
                    'customerID' => $id,
                ])
                ->validate([
                    'customerID' => ['required'],
                ])
                ->request()
                ->get('customerData')
        );
    }

    /**
     * @param int $id
     * @return Collection
     * @throws BinotelException
     */
    public function takeByLabel(int $id): Collection
    {
        return CustomerDataTransferObject::collectFromArray(
            $this->method('take-by-label')
                ->params([
                    'labelID' => $id,
                ])
                ->validate([
                    'labelID' => ['required', 'numeric'],
                ])
                ->request()
                ->get('customerData')
        );
    }

    /**
     * @param string $subject
     * @return Collection
     * @throws BinotelException
     */
    public function search(string $subject): Collection
    {
        return CustomerDataTransferObject::collectFromArray(
            $this->method('search')
                ->params([
                    'subject' => $subject,
                ])
                ->validate([
                    'subject' => ['required', 'string'],
                ])
                ->request()
                ->get('customerData')
        );
    }

    /**
     * @param array $params
     * @return int
     * @throws BinotelException
     */
    public function create(array $params): int
    {
        return (int) $this->method('create')
            ->params($params)
            ->validate($this->validationRules())
            ->request()
            ->get('customerID');
    }

    /**
     * @param array $params
     * @throws BinotelException
     */
    public function update(array $params): void
    {
        $this->method('update')
            ->params($params)
            ->validate($this->validationRules())
            ->request();
    }

    /**
     * @param int $id
     * @throws BinotelException
     */
    public function delete(int $id): void
    {
        $this->method('delete')
            ->params([
                'customerID' => $id,
            ])
            ->request();
    }

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function listOfLabels(): Collection
    {
        return LabelDataTransferObject::collectFromArray(
            $this
                ->method('listOfLabels')
                ->request()
                ->get('listOfLabels')
        );
    }

    private function validationRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'numbers.*' => ['required', 'string', 'size:10'],
            'description' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'assignedToEmployee.internalNumber' => ['nullable', 'numeric'],
            'assignedToEmployee.id' => ['nullable', 'numeric'],
            'labels.id' => ['nullable', 'numeric'],
            'labels.name' => ['nullable', 'string'],
        ];
    }
}
