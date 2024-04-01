<?php

namespace Sashalenz\Binotel\ApiModels;

use Sashalenz\Binotel\Exceptions\BinotelException;
use Sashalenz\Binotel\ResponseData\CustomerData;
use Sashalenz\Binotel\ResponseData\LabelData;
use Spatie\LaravelData\DataCollection;

final class Customers extends BaseModel
{
    protected string $model = 'customers';

    /**
     * @return DataCollection
     * @throws BinotelException
     */
    public function list(): DataCollection
    {
        return $this
            ->method(__FUNCTION__)
            ->toCollection(CustomerData::class);
    }

    /**
     * @param int|array $id
     * @return DataCollection
     * @throws BinotelException
     */
    public function takeById(int | array $id): DataCollection
    {
        return $this
            ->method('take-by-id')
            ->params([
                'customerID' => $id,
            ])
            ->validate([
                'customerID' => ['required'],
            ])
            ->toCollection(CustomerData::class, 'customerData');
    }

    /**
     * @param int $id
     * @return DataCollection
     * @throws BinotelException
     */
    public function takeByLabel(int $id): DataCollection
    {
        return $this
            ->method('take-by-label')
            ->params([
                'labelID' => $id,
            ])
            ->validate([
                'labelID' => ['required', 'numeric'],
            ])
            ->toCollection(CustomerData::class, 'customerData');
    }

    /**
     * @param string $subject
     * @return DataCollection
     * @throws BinotelException
     */
    public function search(string $subject): DataCollection
    {
        return $this
            ->method('search')
            ->params([
                'subject' => $subject,
            ])
            ->validate([
                'subject' => ['required', 'string'],
            ])
            ->toCollection(CustomerData::class, 'customerData');
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
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfLabels(): DataCollection
    {
        return $this
            ->method('listOfLabels')
            ->toCollection(LabelData::class, 'listOfLabels');
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
