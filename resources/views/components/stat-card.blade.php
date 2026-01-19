@props(['title','value','color' => 'gray'])

<div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-{{ $color }}-500">
    <div class="text-sm text-gray-500">{{ $title }}</div>
    <div class="text-2xl font-bold text-{{ $color }}-600 mt-1">
        {{ $value }}
    </div>
</div>
