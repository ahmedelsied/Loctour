<?php

namespace App\Support;

use Carbon\Carbon;

class Formats
{
    public function __construct(protected $input)
    {
    }

    public function dateTime(): string
    {
        if ($this->input === null) {
            return '----/--/-- --:-- --';
        }
        $carbon = $this->input instanceof Carbon ? $this->input : Carbon::parse($this->input);

        return $carbon->format('Y/m/d h:i a');
    }

    public function humanDate(): string
    {
        if ($this->input === null) {
            return '----/--/-- --:-- --';
        }
        $carbon = $this->input instanceof Carbon ? $this->input : Carbon::parse($this->input);

        return $carbon->diffForHumans().'<br>'.$carbon->format('Y/m/d h:i a');
    }

    public function phone($country = 'EG')
    {
        return rescue(function () use ($country) {
            return str_replace(' ', '', phone($this->input, $country)->formatE164());
        }, $this->input, false);
    }

    public function money($unit = 'EGP', $decimal = 2)
    {
        if ($this->input === null) {
            return '0 '.$unit;
        }

        return number_format($this->input, $decimal).' '.$unit;
    }
}
