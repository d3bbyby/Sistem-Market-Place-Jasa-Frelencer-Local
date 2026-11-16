@extends('layouts.freelancer')

@section('content')

    <div class="page-title">
        <h1>Pengaturan Profil</h1>
        <p>Kelola informasi akun FreelancerHub kamu.</p>
    </div>

    <div class="profile-card">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="profile-card" style="margin-top: 20px;">
        @include('profile.partials.update-password-form')
    </div>

    <div class="profile-card" style="margin-top: 20px;">
        @include('profile.partials.delete-user-form')
    </div>

@endsection
