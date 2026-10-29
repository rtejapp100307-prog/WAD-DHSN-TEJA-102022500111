

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kurir</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header class="mainHeader">
    <h1>Edit Data Kurir</h1>
</header>

<div class="form-box">
    <form action="{{ route('kurir.update', $kurir->id_kurir) }}" method="POST">
        @csrf
        @method('PUT')

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
        <input type="text" name="id_kurir" value="{{ old('id_kurir', $kurir->id_kurir) }}" required>
        <br><br>
        <label>Nama Kurir:</label><br>
        <input type="text" name="nama_kurir" value="{{ old('nama_kurir', $kurir->nama_kurir) }}" required>
        <br><br>
        <label>No. HP:</label><br>
        <input type="text" name="no_hp" value="{{ old('no_hp', $kurir->no_hp) }}" required>
        <br><br>
        <label>Jasa Pengiriman:</label><br>
        <input type="text" name="jasa_pengiriman" value="{{ old('jasa_pengiriman', $kurir->jasa_pengiriman) }}" required>
        <br><br>
        <label>Jenis Layanan:</label><br>
        <select name="jenis_layanan" required>
            <option value="Reguler" {{ old('jenis_layanan', $kurir->jenis_layanan) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
            <option value="Express" {{ old('jenis_layanan', $kurir->jenis_layanan) == 'Express' ? 'selected' : '' }}>Express</option>
        </select>

        <br><br>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('kurir.index') }}">Kembali</a>
    </form>
</div>

</body>
</html>
