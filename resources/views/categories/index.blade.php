<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori Iuran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Kategori Iuran</h1>
            <a href="{{ route('categories.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Kategori
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Nama</th>
                    <th class="p-2">Default</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $cat)
                    <tr class="border-t">
                        <td class="p-2">{{ $cat->name }}</td>
                        <td class="p-2 text-center">
                            Rp {{ number_format($cat->default_amount ?? 0) }}
                        </td>
                        <td class="p-2 text-center">
                            {{ $cat->is_active ? 'Aktif' : 'Nonaktif' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Belum ada kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
