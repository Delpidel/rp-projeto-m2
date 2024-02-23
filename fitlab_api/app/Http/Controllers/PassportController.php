<?php

namespace App\Http\Controllers;

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class PassportController extends AccessTokenController
{
    /**
     * Authorize a client to access the user's account.
     *
     * @param  ServerRequestInterface  $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        $response = parent::issueToken($request);

        $content = json_decode($response->getContent(), true);

        if (isset($content['access_token'])) {
            $content['token'] = $content['access_token'];
            unset($content['access_token']);
        }

        return response()->json($content);
    }
}
