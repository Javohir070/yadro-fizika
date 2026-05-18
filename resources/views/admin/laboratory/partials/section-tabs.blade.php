@php
    $tabs = [
        'about' => 'Laboratoriya haqida',
        'team' => 'Laboratoriya tarkibi',
        'scientific' => 'Ilmiy faoliyat',
        'international' => 'Xalqaro hamkorlik',
    ];
@endphp

<ul class="nav nav-pills laboratory-section-tabs gap-2 mb-4 p-2 bg-body-secondary bg-opacity-50 rounded-3">
    @foreach ($tabs as $key => $label)
        <li class="nav-item flex-fill">
            <a class="nav-link text-center fw-semibold {{ ($tab ?? 'about') === $key ? 'active' : '' }}"
                href="{{ route('admin.laboratories.edit', ['laboratory' => $laboratory, 'tab' => $key]) }}">
                {{ $label }}
            </a>
        </li>
    @endforeach
</ul>
