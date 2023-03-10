<?php

namespace Sashalenz\Binotel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebhookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return array_key_exists(
            $this->ip(),
            $this->allowedIPs()
        );
    }

    public function rules(): array
    {
        return [
            'requestType' => ['required', 'string'],
        ];
    }

    private function allowedIPs(): array
    {
        return [
            '194.88.218.116' => 'my.binotel.ua',
            '194.88.218.114' => 'sip1.binotel.com',
            '194.88.218.117' => 'sip2.binotel.com',
            '194.88.218.118' => 'sip3.binotel.com',
            '194.88.219.67' => 'sip4.binotel.com',
            '194.88.219.78' => 'sip5.binotel.com',
            '194.88.219.70' => 'sip6.binotel.com',
            '194.88.219.71' => 'sip7.binotel.com',
            '194.88.219.72' => 'sip8.binotel.com',
            '194.88.219.79' => 'sip9.binotel.com',
            '194.88.219.80' => 'sip10.binotel.com',
            '194.88.219.81' => 'sip11.binotel.com',
            '194.88.219.82' => 'sip12.binotel.com',
            '194.88.219.83' => 'sip13.binotel.com',
            '194.88.219.84' => 'sip14.binotel.com',
            '194.88.219.85' => 'sip15.binotel.com',
            '194.88.219.86' => 'sip16.binotel.com',
            '194.88.219.87' => 'sip17.binotel.com',
            '194.88.219.88' => 'sip18.binotel.com',
            '194.88.219.89' => 'sip19.binotel.com',
            '194.88.219.92' => 'sip20.binotel.com',
            '194.88.218.119' => 'sip21.binotel.com',
            '194.88.218.120' => 'sip22.binotel.com',
            '185.100.66.145' => 'sip50.binotel.com',
            '185.100.66.146' => 'sip51.binotel.com',
            '185.100.66.147' => 'sip52.binotel.com',
        ];
    }
}
