<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2']) }}>
        {{ $slot }}
    </button>
</form>