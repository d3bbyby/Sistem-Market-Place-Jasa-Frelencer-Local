<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui foto profil, nama, dan alamat email akun kamu.
        </p>
    </header>

    <form method="post"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="mt-6 space-y-6">

        @csrf
        @method('patch')

        {{-- Foto Profil --}}
        <div>
            <x-input-label for="profile_photo" value="Foto Profil" />

            <div class="mt-3 flex items-center gap-4">
                @if ($user->profile_photo)
                    <img
                        src="{{ asset('storage/' . $user->profile_photo) }}"
                        alt="Foto Profil"
                        class="w-20 h-20 rounded-full object-cover"
                    >
                @else
                    <div class="w-20 h-20 rounded-full bg-purple-600 text-white flex items-center justify-center text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <input
                        id="profile_photo"
                        name="profile_photo"
                        type="file"
                        accept="image/jpeg,image/png,image/webp"
                        class="block text-sm text-gray-600"
                    >

                    <p class="mt-1 text-xs text-gray-500">
                        JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </p>
                </div>
            </div>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('profile_photo')"
            />
        </div>

        {{-- Nama --}}
        <div>
            <x-input-label for="name" value="Nama Lengkap" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                Simpan Perubahan
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600">
                    Profil berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>

    {{-- Verifikasi Email --}}
    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
        && \Illuminate\Support\Facades\Route::has('verification.send')
        && ! $user->hasVerifiedEmail())

        <div class="mt-4">
            <p class="text-sm text-gray-800">
                Alamat email kamu belum diverifikasi.
            </p>

            <form method="post" action="{{ route('verification.send') }}">
                @csrf

                <button class="underline text-sm text-gray-600 mt-2">
                    Kirim ulang email verifikasi
                </button>
            </form>
        </div>
    @endif
</section>
