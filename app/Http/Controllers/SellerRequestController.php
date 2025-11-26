<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SellerVerification;
use App\Notifications\RequestSellerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRequestController extends Controller
{
    // USER mengirim request menjadi seller
    public function requestSeller()
    {
        $user = Auth::user();

        // Cek jika user sudah pernah request
        $existing = SellerVerification::where('user_id', $user->id)->first();

        if ($existing && $existing->status === 'pending') {
            return back()->with('error', 'Permintaan Anda masih menunggu persetujuan.');
        }

        if ($existing && $existing->status === 'verified') {
            return back()->with('error', 'Anda sudah menjadi seller.');
        }

        // Buat request baru
        SellerVerification::updateOrCreate(
            ['user_id' => $user->id],
            ['status' => 'pending']
        );

        // Notifikasi ke admin
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new RequestSellerNotification($user));

        return back()->with('success', 'Permintaan menjadi seller telah dikirim.');
    }

    // ADMIN melihat semua request
    public function index()
    {
        $requests = SellerVerification::with('user')
            ->where('status', 'pending')
            ->get();

        return view('admin.seller_request.index', compact('requests'));
    }

    // ADMIN menyetujui request
    public function approve($id)
    {
        $request = SellerVerification::findOrFail($id);

        $request->update([
            'status' => 'verified',
            'verified_at' => now(),
        ]);

        // Update role user
        $request->user->update([
            'role' => 'seller'
        ]);

        return back()->with('success', 'User berhasil diubah menjadi seller.');
    }

    // ADMIN menolak request
    public function reject($id)
    {
        $request = SellerVerification::findOrFail($id);

        $request->update([
            'status' => 'rejected'
        ]);

        return back()->with('error', 'Permintaan seller ditolak.');
    }
}
