<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;

class ReceiptController extends Controller
{
    public function downloadReceipt()
    {
        $purchaseData = session('purchaseData');

        $pdf = PDF::loadView('receipt', [
            'purchaseData' => $purchaseData,
        ]);

        return $pdf->download('receipt.pdf');
        return route('/keranjangs');
    }
}
