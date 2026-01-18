<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Tambah Kategori Iuran</h1>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">Nama Iuran</label>
                <input type="text" name="name"
                       class="w-full border px-3 py-2 rounded"
                       required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Default Nominal</label>
                <input type="number" name="default_amount"
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label>
                    <input type="checkbox" name="is_active" checked>
                    Aktif
                </label>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 border rounded">
                    Batal
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>

            <div class="mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" name="is_cash_based" value="1" checked>
        <span class="ml-2">Masuk Saldo Kas</span>
    </label>
    <p class="text-sm text-gray-500 mt-1">
        Matikan untuk item khusus seperti WiFi / Listrik
    </p>
</div>

        </form>
    </div>

</body>
</html>
