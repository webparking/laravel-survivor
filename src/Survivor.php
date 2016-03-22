<?php

namespace Influendo\LaravelSurvivor;

class Survivor
{
    /**
     * Return the script tag for the survivor lib
     *
     * @return string
     */
    public function getScript()
    {
        $script = view('survivor::script')->with([
            'token'          => csrf_token(),
            'url'            => route('survivor.ping'),
            'interval'       => config('survivor.interval', 300000),
            'input_elements' => config('survivor.input_elements', 'input[name=_token]'),
        ])->render();

        return preg_replace('!\s+!', ' ', $script);
    }
}
