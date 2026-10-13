<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function index()
    {
        $freelancers = User::where('role', 'freelancer')->get();

        return view('admin.freelancers.index', compact('freelancers'));
    }

    public function verify(User $user)
    {
        abort_unless($user->role === 'freelancer', 404);

        $user->verification_status = 'verified';
        $user->save();

        return redirect()->route('admin.freelancers.index')
            ->with('success', 'Freelancer berhasil diverifikasi.');
    }

    public function reject(User $user)
    {
        abort_unless($user->role === 'freelancer', 404);

        $user->verification_status = 'rejected';
        $user->save();

        return redirect()->route('admin.freelancers.index')
            ->with('success', 'Freelancer berhasil ditolak.');
    }
}