<?php

namespace Influendo\LaravelSurvivor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Encryption\Encrypter;

class SurvivorController extends Controller
{
    /**
     * The encrypter implementation.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $encrypter;

    /**
     * Init dependencies
     *
     * @param  \Illuminate\Contracts\Encryption\Encrypter  $encrypter
     * @return void
     */
    public function __construct(Encrypter  $encrypter)
    {
        $this->encrypter = $encrypter;
    }

    /**
     * Return empty content, just keep the app alive
     *
     * @return Response
     */
    public function ping(Request $request)
    {
        if ( ! $this->tokensMatch($request)) {
            return response(['_token' => csrf_token()]);
        }

        return response('', 204);
    }

    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        // Get tokens from session and the request
        $sessionToken = $request->session()->token();
        $token        = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');

        if ( ! $token && $header = $request->header('X-XSRF-TOKEN')) {
            $token = $this->encrypter->decrypt($header);
        }

        if ( ! is_string($sessionToken) || ! is_string($token)) {
            return false;
        }

        // Validate them
        return hash_equals((string) $request->session()->token(), (string) $token);
    }
}
