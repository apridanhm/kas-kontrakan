<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <h1 class="text-xl font-semibold text-gray-800">
        {{ $title }}
    </h1>

    @isset($action)
        <div class="mt-3 sm:mt-0">
            {{ $action }}
        </div>
    @endisset
</div>
