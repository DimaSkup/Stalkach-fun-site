<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(Request $request) {
        if ($request->server->get('HTTP_HOST') === '127.0.0.1:8000') {
            return redirect()->to('http://localhost:8000');
        }

        return view('landing.new', [
            'disabledMenuBlur' => false,
        ]);
    }

    public function error()
    {
        abort(500);
    }

    public function components(Request $request)
    {
        return view('_components');
    }

    public function template($tempKey)
    {
        return view($tempKey);
    }

    public function language($locale): RedirectResponse
    {
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
