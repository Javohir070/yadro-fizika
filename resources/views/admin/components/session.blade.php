@php
    $messages = [
        'create' => ['class' => 'success', 'text' => "Ma'lumotlar muvaffaqiyatli yaratildi."],
        'delete' => ['class' => 'danger', 'text' => "Ma'lumotlar muvaffaqiyatli o'chirildi."],
        'update' => ['class' => 'warning', 'text' => "Ma'lumotlar muvaffaqiyatli o'zgartirildi!"],
        'error' => ['class' => 'danger', 'text' => "Xatolik yuz berdi."],
        'success' => ['class' => 'success', 'text' => "Ma'lumotlar muvaffaqiyatli tasdiqlandi."],
        'import' => ['class' => 'success', 'text' => "Ma'lumotlar muvaffaqiyatli import qilindi."]
    ];
@endphp
<style>
    .toast {
        position: fixed;
        /* bottom: 20px; */
        top:100px;
        right: 20px;
        background: white;
        border-left: 4px solid green;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: Arial, sans-serif;
    }

    .icon {
        color: green;
        font-size: 20px;
    }

    .toast button {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        margin-left: auto;
        color: gray;
    }
</style>
@if (session('status') && isset($messages[session('status')]))
    <div class="position-fixed top-2 end-5 p-3" style="z-index: 11">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            {{ $messages[session('status')]['text'] }}
        </div>
    </div>
@endif

{{-- <div id="toast" class="toast">
    <div class="icon">✔</div>
    <div>
        <strong>Successfully</strong>
        <p>Connection error. Unable to connect to the server at present.</p>
    </div>
    <button onclick="closeToast()">×</button>
</div> --}}

{{-- @if (session('status'))
    <div class="position-fixed top-5 end-0 p-3" style="z-index: 11">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small class="text-body-secondary">Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('status') }}
            </div>
        </div>
    </div>
@endif --}}
