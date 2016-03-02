<?php

if ( ! function_exists('survivor')) {
    /**
     * Return survivor script
     *
     * @return string
     */
    function survivor()
    {
        return app('Influendo\LaravelSurvivor\Survivor')->getScript();
    }
}
