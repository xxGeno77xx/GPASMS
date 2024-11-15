<?php

namespace App\Http\Controllers;

use App\Models\Notation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function stream(Notation $record)
    {
       
        return Pdf::loadView('NotationSheet', ['record' => $record])
            ->stream($record->id.'.pdf');
    }
}
