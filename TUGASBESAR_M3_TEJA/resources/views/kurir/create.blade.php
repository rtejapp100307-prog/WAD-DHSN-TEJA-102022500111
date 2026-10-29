
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kurir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="mainHeader">
    <h1>Tambah Data Kurir</h1>
</header>



<div class="form-box">
    <form action="{{ route('kurir.store') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label>ID Kurir:</label><br>
        <input type="text" name="id_kurir" value="{{ old('id_kurir') }}" required>
        <br><br>

        <label>Nama Kurir:</label><br>
        <input type="text" name="nama_kurir" value="{{ old('nama_kurir') }}" required>
        <br><br>

        <label>No. HP:</label><br>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required>
        <br><br>

        <label>Jasa Pengiriman:</label><br>
        <input type="text" name="jasa_pengiriman" value="{{ old('jasa_pengiriman') }}" required>
        <br><br>

        <label>Jenis Layanan:</label>
        <select name="jenis_layanan" required>
            <option value="">[Pilih Layanan]</option>
            <option value="Reguler" {{ old('jenis_layanan') == 'Reguler' ? 'selected' : '' }}>Reguler</option>
            <option value="Express" {{ old('jenis_layanan') == 'Express' ? 'selected' : '' }}>Express</option>
        </select>

        <br><br>
        <button type="submit">Tambah Data</button>
        <a href="{{ route('kurir.index') }}" class="btn-tutup">&times;</a>
    </form>
</div>

</body>
</html>
