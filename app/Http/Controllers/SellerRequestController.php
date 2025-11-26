<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SellerVerification;
use App\Notifications\RequestSellerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRequestController extends Controller
{
    // Show form for user to request becoming a seller
    public function showRequestForm()
    {
        return view('user.request');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $sellerVerification = SellerVerification::where('user_id', $user->id)->firstOrFail();

        return view('admin.seller_request.show', compact('user', 'sellerVerification'));
    }

    // USER mengirim request menjadi seller
    public function requestSeller(Request $request)
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

        // Validate incoming store data
        $data = $request->validate([
            'store_name' => ['required', 'string', 'max:100'],
            'store_description' => ['nullable', 'string', 'max:255'],
        ]);

        // Save store info to user profile
        $user->update([
            'store_name' => $data['store_name'],
            'store_description' => $data['store_description'] ?? null,
        ]);

        // Buat request baru
        SellerVerification::updateOrCreate(
            ['user_id' => $user->id],
            ['status' => 'pending']
        );

        // Notifikasi ke admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new RequestSellerNotification($user));
        }

        return redirect()->route('home')->with('success', 'Permintaan menjadi seller telah dikirim.');
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
