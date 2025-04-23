<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnValue;

class pruebaController extends Controller
{
    public function __invoke()
    {
        $var1 = "Jonas";
        $var2 = 'Pedro';
        return view('prueba', compact('var1','var2'));
    }
}
