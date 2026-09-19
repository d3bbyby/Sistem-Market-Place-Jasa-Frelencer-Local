<h2>Tambah Kategori Baru</h2>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label>Nama Kategori:</label>
    <input type="text" name="category_name" required>
    <button type="submit">Simpan</button>
</form>