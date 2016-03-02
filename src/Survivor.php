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
        return view('survivor::script')->with([
            'token'    => csrf_token(),
            'url'      => route('survivor.ping'),
            'interval' => config('survivor.interval', 300000),
        ]);
    }
}
