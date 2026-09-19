<h2>Edit Kategori</h2>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nama Kategori:</label>
    <input type="text" name="category_name" value="{{ $category->category_name }}" required>
    <button type="submit">Update</button>
</form>