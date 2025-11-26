<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SellerVerification;
use App\Notifications\RequestSellerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerVerificationController extends Controller
{
    // User mengajukan permintaan jadi seller
    public function request()
    {
        $user = Auth::user();

        // Cek apakah sudah pernah request
        if ($user->sellerVerification) {
            return back()->with('error', 'You already submitted a seller request.');
        }

        SellerVerification::create([
            'user_id' => $user->id,
            'status'  => 'pending',
        ]);

        // beri notifikasi ke admin
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new RequestSellerNotification($user));

        return back()->with('success', 'Seller request submitted to admin.');
    }

    // Admin menyetujui
    public function approve($id)
    {
        $request = SellerVerification::findOrFail($id);

        $request->update([
            'status' => 'verified',
            'verified_at' => now(),
        ]);

        // ubah user role
        $request->user->update(['role' => 'seller']);

        return back()->with('success', 'User approved as seller.');
    }

    // Admin menolak
    public function reject(Request $httpRequest, $id)
    {
        $request = SellerVerification::findOrFail($id);

        $request->update([
            'status' => 'rejected',
            'note' => $httpRequest->note,
        ]);

        return back()->with('error', 'Seller request rejected.');
    }
}
