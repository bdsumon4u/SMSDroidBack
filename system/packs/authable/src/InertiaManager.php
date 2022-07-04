<?php

namespace Hotash\Authable;

use Hotash\Authable\Facades\Authable;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Jetstream\InertiaManager as Manager;

class InertiaManager extends Manager
{
    /**
     * Render the given Inertia page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $page
     * @param  array  $data
     * @return \Inertia\Response
     */
    public function render(Request $request, string $page, array $data = [])
    {
        if (isset($this->renderingCallbacks[$page])) {
            foreach ($this->renderingCallbacks[$page] as $callback) {
                $data = $callback($request, $data);
            }
        }

        return Inertia::render(Authable::viewSpace().$page, $data);
    }
}
