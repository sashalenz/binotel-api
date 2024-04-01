<?php

namespace Sashalenz\Binotel\ApiModels;

use Illuminate\Support\Collection;
use Sashalenz\Binotel\Exceptions\BinotelException;
use Sashalenz\Binotel\ResponseData\SettingsEmployeeData;
use Sashalenz\Binotel\ResponseData\SettingsRouteData;
use Sashalenz\Binotel\ResponseData\SettingsVoiceFileData;
use Spatie\LaravelData\DataCollection;

final class Settings extends BaseModel
{
    protected string $model = 'settings';

    /**
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfEmployees(): DataCollection
    {
        return $this
            ->method('list-of-employees')
            ->cache(5)
            ->toCollection(SettingsEmployeeData::class, 'listOfEmployees');
    }

    /**
     * @return Collection
     * @throws BinotelException
     */
    public function listOfRoutes(): Collection
    {
        $data = $this->method('list-of-routes')
            ->cache(5)
            ->get('listOfRoutes');

        return collect($data)
            ->mapWithKeys(fn ($array, $key) => [
                $key => SettingsRouteData::collect($array),
            ]);
    }

    /**
     * @return DataCollection
     * @throws BinotelException
     */
    public function listOfVoiceFiles(): DataCollection
    {
        return $this
            ->method('list-of-voice-files')
            ->cache(5)
            ->toCollection(SettingsVoiceFileData::class, 'listOfEmployees');
    }
}
