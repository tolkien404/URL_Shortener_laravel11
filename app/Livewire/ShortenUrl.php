<?php

namespace App\Livewire;

use App\Models\Url;
use Livewire\Component;

class ShortenUrl extends Component
{
    public string $url;

    public string $result;

    public function rules()
    {
        return [
            'url' => ['required', 'url'],
        ];
    }

    public function submit()
    {
        $this->validate();
        $code = str()->random(7);
        $url = Url::firstOrCreate(
            [
                'url' => $this->url
            ],
            [
                'code' => $code
            ]
        );
        $this->result = $url->shortUrl;
//        $this->emit('resultGenerated');
    }

    public function render()
    {
        return view('livewire.shorten-url');
    }
}
