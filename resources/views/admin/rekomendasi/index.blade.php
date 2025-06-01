@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6">Manajemen Rekomendasi Barang</h2>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success mb-4">
            <div class="text-green-600 bg-green-100 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Rekomendasi saat ini --}}
    <div class="card mb-6 shadow-lg rounded-lg">
        <div class="card-header bg-blue-500 text-white p-4 rounded-t-lg">Barang yang Direkomendasikan</div>
        <div class="card-body p-4">
            @if($rekomendasi->isEmpty())
                <p>Belum ada rekomendasi barang.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($rekomendasi as $item)
                        <li class="flex justify-between items-center p-3 border border-gray-300 rounded-lg">
                            <span>{{ $item->barang->nama_barang }}</span>
                            <form action="{{ route('admin.rekomendasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus rekomendasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md">Hapus</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Form for Adding Item Recommendation --}}
    <form id="rekomendasiForm" action="{{ route('admin.rekomendasi.index') }}" method="GET">
    @csrf
    <!-- Pilih User -->
    <div class="mb-4">
        <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih User</label>
        <select name="user_id" id="user_id" class="form-select mt-1 block w-full bg-gray-100 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">-- Pilih User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
            @endforeach
        </select>
    </div>
</form>

<!-- Category Checkboxes -->
<div>
    @foreach($kategori as $ktg)
        <div class="flex items-center">
            <input type="checkbox" name="kategori_ids[]" value="{{ $ktg->id_kategori }}" class="form-check-input" id="kategori{{ $ktg->id_kategori }}">
            <label class="form-check-label ml-2" for="kategori{{ $ktg->id_kategori }}">{{ $ktg->nama_kategori }}</label>
        </div>
    @endforeach
</div>

<!-- Items based on selected category -->
<div id="barang-items">
    <!-- Barang items will be loaded here -->
</div>

<script>
document.getElementById('user_id').addEventListener('change', function() {
    var userId = this.value;
    var kategoriIds = [];
    document.querySelectorAll('input[name="kategori_ids[]"]:checked').forEach(function(checkbox) {
        kategoriIds.push(checkbox.value);
    });

    // Make AJAX request to fetch items based on the selected user and categories
    fetch('{{ route('admin.rekomendasi.index') }}?user_id=' + userId + '&kategori_ids=' + kategoriIds.join(','))
        .then(response => response.json())
        .then(data => {
            // Update the items section with the fetched items
            document.getElementById('barang-items').innerHTML = data.items;
        });
});
</script>


        <button type="submit" class="btn btn-primary mt-3 bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-md">Tambah Rekomendasi</button>
    </form>
  </div>
@endsection