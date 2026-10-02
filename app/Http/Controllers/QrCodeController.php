<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function showQrScanner()
    {
        return view('qr.scan');
    }

    public function checkGroup(Request $request)
    {
        $id = $request->query('id');

        // Check if the group exists
        $group = Group::find($id);

        if ($group) {
            return response()->json([
                'exists' => true,
                'url' => route('groups.join', $id),
            ]);
        } else {
            return response()->json([
                'exists' => false,
            ]);
        }
    }

}
