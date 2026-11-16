<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->safe()->only([
            'name',
            'email',
            'whatsapp_number'
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $data['profile_photo'] = $request->file('profile_photo')
                ->store('profile-photos', 'public');
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->role === 'client') {
            return redirect()->route('client.profile')
                ->with('status', 'profile-updated');
        }

        if ($user->role === 'freelancer') {
            return redirect()->route('freelancer.profil')
                ->with('status', 'profile-updated');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.profil')
                ->with('status', 'profile-updated');
        }

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    public function deletePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);

            $user->profile_photo = null;
            $user->save();
        }

        if ($user->role === 'freelancer') {
            return redirect()->route('freelancer.profil')
                ->with('status', 'photo-deleted');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.profil')
                ->with('status', 'photo-deleted');
        }

        return redirect()->route('client.profile')
            ->with('status', 'photo-deleted');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
