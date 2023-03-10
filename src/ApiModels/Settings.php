<?php

namespace Sashalenz\Binotel\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Binotel\DataTransferObjects\SettingsEmployeeDataTransferObject;
use Sashalenz\Binotel\DataTransferObjects\SettingsRouteDataTransferObject;
use Sashalenz\Binotel\DataTransferObjects\SettingsVoiceFileDataTransferObject;
use Sashalenz\Binotel\Exceptions\BinotelException;

final class Settings extends BaseModel
{
    protected string $model = 'settings';

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function listOfEmployees(): Collection
    {
        return SettingsEmployeeDataTransferObject::collectFromArray(
            $this->method('list-of-employees')
                ->cache(5)
                ->request()
                ->get('listOfEmployees')
        );
    }

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function listOfRoutes(): Collection
    {
        $data = $this->method('list-of-routes')
            ->cache(5)
            ->request()
            ->get('listOfRoutes');

        return collect($data)->mapWithKeys(fn ($array, $key) => [
            $key => SettingsRouteDataTransferObject::collectFromArray($array),
        ]);
    }

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function listOfVoiceFiles(): Collection
    {
        return SettingsVoiceFileDataTransferObject::collectFromArray(
            $this->method('list-of-voice-files')
                ->cache(5)
                ->request()
                ->get('listOfEmployees')
        );
    }
}
