@extends('layouts.app')

@section('title', 'Edit Profile')

@php
    static $student = (object) [
    'nama' => 'Aulia Pratama',
    'nim' => '220145678',
    'prodi' => 'Teknik Informatika',
    'angkatan' => '2022',
    'photo_url' => 'https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=800',
    'email_kampus' => 'aulia.pratama@kampus.ac.id',
    'email_pribadi' => 'auliapratama@gmail.com',
    'telepon' => '081234567890',
    'kota' => 'Yogyakarta',
    'bio' => 'Mahasiswa yang tertarik pada pengembangan aplikasi, machine learning, dan kegiatan komunitas kampus.',
];
@endphp

@section('content')
    <x-page-header title="Edit Profil"
        description="Perbarui data pribadi dan preferensi notifikasi untuk pengalaman event yang lebih relevan ✨" />

    <main>
    <x-profile.profile-form
        action="#"
        method="POST"
    >
        <x-profile.header-form
            :photo-url="$student->photo_url"
            :full-name="$student->nama"
            :prodi="$student->prodi"
        />

        <x-profile.student-form
            :full-name="$student->nama"
            :nim="$student->nim"
            :prodi="$student->prodi"
            :angkatan="$student->angkatan"
        />

        <x-profile.contact-form
            :email-kampus="$student->email_kampus"
            :email-pribadi="$student->email_pribadi"
            :telepon="$student->telepon"
            :kota="$student->kota"
        />

        <x-profile.bio-form
            :bio="$student->bio"
        />

        <x-profile.profile-actions
            cancel-url="{{ route('profile') }}"
        />
    </x-student.profile-form>
</main>

@endsection
