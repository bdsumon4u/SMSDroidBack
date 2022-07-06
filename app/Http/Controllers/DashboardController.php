<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard', [
            'token' => $this->token($request),
        ]);
    }

    /**
     * If there is no devices, this will return HotashXMS token.
     * Otherwise, this will return null.
     *
     * @param Request $request
     * @return \Closure
     */
    private function token(Request $request): \Closure
    {
        return function () use (&$request) {
            if ($request->user()->devices()->count()) {
                return null;
            }

            return $request->user()->XMSTokenSvg();
        };
    }
}
