<?php

namespace App\Livewire;

use App\Models\Url;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ShortenUrl extends Component
{
    public string $url;

    public string $result;

    public string $qr;

    public ?string $expires_at = null;

    public function rules()
    {
        return [
            'url' => ['required', 'url'],
            'expires_at' => ['nullable', 'sometimes', 'date', 'after:now'],
        ];
    }

    public function submit()
    {
        $this->validate();
        $code = str()->random(7);
        $url = Url::firstOrCreate(
            [
                'url' => $this->url,
                'expires_at' => $this->expires_at,
            ],
            [
                'code' => $code,
                'expires_at' => $this->expires_at,
            ]
        );

        $this->qr = QrCode::size(200)
            ->backgroundColor(0, 0, 0)
            ->color(255, 255, 255)
            ->margin(1)
            ->generate($url->shortUrl);
        $this->result = $url->shortUrl;
    }

    public function render()
    {
        return view('livewire.shorten-url')->title(config('app.name'));
    }
}
