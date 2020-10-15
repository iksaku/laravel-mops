@props(['for'])

@error($for)
    <div {{ $attributes->merge(['class' => 'text-red-500 text-sm font-base italic']) }}>
        {{ $message }}
    </div>
@enderror
