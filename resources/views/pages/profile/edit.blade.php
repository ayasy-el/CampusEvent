@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <x-page-header title="Edit Profil"
        description="Perbarui data pribadi dan preferensi notifikasi untuk pengalaman event yang lebih relevan ✨" />

    <main>
        <x-profile.profile-form :action="route('profile.update')" method="PUT">
            <x-profile.header-form
                :photo-url="$user?->avatar_url ??
                    'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png?20170328184010'"
                :full-name="$user?->name ?? ''"
                :program-studi="$user?->program_studi ?? ''"
                :show-avatar="true"
                :enable-upload="true"
            />

            <x-profile.student-form :full-name="$user?->name ?? ''" :nrp="$user?->nrp ?? ''" :program-studi="$user?->program_studi ?? ''" :angkatan="$user?->angkatan ?? ''" />

            <x-profile.contact-form :email="$user?->email ?? ''" :telepon="$user?->no_telepon" :kota="$user?->kota" />

            <x-profile.bio-form :bio="$user?->bio" />

            <x-profile.profile-actions cancel-url="{{ route('profile') }}" />
        </x-profile.profile-form>
    </main>

    @push('scripts')
        <script>
            (function() {
                const input = document.getElementById('avatarInput');
                const preview = document.getElementById('avatarPreview');
                const cancel = document.getElementById('avatarCancel');
                if (!input || !preview || !cancel) return;

                const original = preview.style.backgroundImage;

                input.addEventListener('change', () => {
                    const file = input.files?.[0];
                    if (file) {
                        const url = URL.createObjectURL(file);
                        preview.style.backgroundImage = `url('${url}')`;
                    }
                });

                cancel.addEventListener('click', () => {
                    input.value = '';
                    preview.style.backgroundImage = original;
                });
            })();
        </script>
    @endpush

@endsection
