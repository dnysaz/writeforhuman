<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about() { return view('pages.about'); }
    public function help() { return view('pages.help'); }
    public function terms() { return view('pages.terms'); }
    public function support() { return view('pages.support'); }
    public function donate() { return view('pages.donate'); }
}