<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Upload Cicilan</title>
</head>
<body>

<h2>Test Upload Cicilan</h2>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<form method="POST"
      action="{{ route('payments.installment.store', 1) }}"
      enctype="multipart/form-data">
    @csrf

    <div>
        <input type="number" name="amount" placeholder="Nominal bayar" required>
    </div>
    <br>
    <div>
        <input type="file" name="proof" accept="image/*" required>
    </div>
    <br>

    <button type="submit">UPLOAD</button>
</form>

</body>
</html>
