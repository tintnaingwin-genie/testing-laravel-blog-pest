<?php

namespace App\Http\Controllers;

use App\Models\Redirect;

class RedirectAdminController
{
    public function index()
    {
        $redirects = Redirect::query()->orderByDesc('created_at')->paginate(100);

        return view('redirectAdmin.index', [
            'redirects' => $redirects,
        ]);
    }
}
