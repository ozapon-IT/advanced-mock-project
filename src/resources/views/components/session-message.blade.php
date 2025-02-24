@if ($errorMessage)
    <div class="message message--alert">
        <span>{{ $errorMessage }}</span>
    </div>
@elseif ($successMessage)
    <div class="message">
        <span>{{ $successMessage }}</span>
    </div>
@endif