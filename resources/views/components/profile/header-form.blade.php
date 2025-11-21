@props([
    'photoUrl' => '',
    'fullName' => '-',
    'programStudi' => '-',
    'showAvatar' => true,
    'enableUpload' => false,
])

@php
    $avatarId = uniqid('avatar_preview_');
    $inputId = "{$avatarId}_input";
    $cancelId = "{$avatarId}_cancel";
@endphp

<section class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="flex items-center gap-3">
        @if ($showAvatar)
            <div id="{{ $avatarId }}"
                class="w-14 h-14 md:w-16 md:h-16 rounded-3xl bg-cover bg-center border border-slate-200"
                style="background-image: url('{{ $photoUrl }}')"></div>
        @endif
        <div class="text-xs md:text-sm text-slate-700">
            <p class="font-semibold text-slate-900">{{ $fullName }}</p>
            <p class="text-[11px] md:text-xs text-slate-500">
                Mahasiswa • {{ $programStudi }}
            </p>
            @if ($enableUpload)
                <input class="mt-2" id="{{ $inputId }}" type="file" name="avatar" accept="image/*"
                    class="text-xs md:text-sm" />
                <button type="button" id="{{ $cancelId }}" class="text-[11px] md:text-xs text-slate-600 underline">
                    Cancel
                </button>
            @endif
        </div>
    </div>


</section>

@push('scripts')
    <script>
        (function() {
            const input = document.getElementById('{{ $inputId }}');
            const preview = document.getElementById('{{ $avatarId }}');
            const cancel = document.getElementById('{{ $cancelId }}');
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
