<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwapHub - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F5F7FA;
            margin: 0;
        }

        .dashboard-page {
            width: 100%;
            background: #FFFFFF;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            background: #FFFFFF;
            height: 80px;
        }

        .bottom-bar {
            width: 100%;
            height: 10px;
            background: #2194F3;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 80px;
            height: 80px;
        }

        .logo-text {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 24px;
            color: #2194F3;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-profile svg {
            width: 24px;
            height: 24px;
            fill: #717171;
        }

        .user-profile span {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 16px;
            color: #263238;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .search-bar {
            padding: 20px 5%;
            background: #F5F7FA;
            text-align: center;
        }

        .search-bar input {
            width: 50%;
            padding: 10px 20px;
            border: 1px solid #CFCFCF;
            border-radius: 20px;
            font-family: 'Inter';
            font-size: 14px;
            color: #263238;
        }

        .search-bar input::placeholder {
            color: #717171;
            opacity: 0.7;
        }

        .categories {
            display: flex;
            justify-content: center;
            gap: 60px;
            padding: 20px 5%;
            background: #F5F7FA;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .category-item:hover {
            transform: scale(1.1);
        }

        .category-item.selected {
            transform: scale(1.1);
        }

        .category-item.selected span {
            color: #2194F3;
            font-weight: 600;
        }

        .category-item svg {
            width: 40px;
            height: 40px;
            fill: #263238;
        }

        .category-item span {
            font-family: 'Inter';
            font-weight: 500;
            font-size: 14px;
            color: #263238;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .just-for-you, .daftar-barang {
            padding: 40px 5%;
            background: #FFFFFF;
        }

        .daftar-barang {
            background: #F5F7FA;
        }

        .section-title {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 24px;
            color: #003459;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .section-subtitle {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 16px;
            color: #717171;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .item-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .item-card {
            background: #F5F7FA;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .item-card img {
            max-w-full;
            max-h-full;
            object-fit: cover;
        }

        .item-card .details {
            padding: 10px;
            text-align: center;
        }

        .item-card .details p.description {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 12px;
            color: #263238;
            margin-bottom: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .item-card .details a, .item-card .details button {
            background: #4CAF4F;
            color: #FFFFFF;
            padding: 5px 15px;
            border: none;
            border-radius: 5px;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .item-card .details a.edit, .item-card .details button.delete {
            background: #FBBF24;
        }

        .item-card .details button.delete {
            background: #EF4444;
        }

        .notification {
            margin: 20px 5%;
        }

        .notification .success {
            background: #4CAF4F;
            color: #FFFFFF;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .notification .error {
            background: #EF4444;
            color: #FFFFFF;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .notification .unread {
            background: #3B82F6;
            color: #FFFFFF;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification .unread span {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .notification .unread a {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 20px 5%;
        }

        .action-buttons a {
            padding: 10px 20px;
            border-radius: 5px;
            color: #FFFFFF;
            font-family: 'Inter';
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .action-buttons a.tambah {
            background: #3B82F6;
        }

        .action-buttons a.permintaan {
            background: #8B5CF6;
        }

        .footer {
            padding: 30px 5%;
            background: #003459;
            color: #FFFFFF;
        }

        .footer p.slogan {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-links div {
            flex: 1;
        }

        .footer-links h4 {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            margin-bottom: 5px;
        }

        .footer-links ul li a {
            font-family: 'Inter';
            font-weight: 400;
            font-size: 14px;
            color: #FFFFFF;
            text-decoration: none;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .footer-links .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-links .social-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .footer-links .social-icons svg {
            width: 24px;
            height: 24px;
            fill: #FFFFFF;
        }

        .footer-links .email-input {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .footer-links .email-input input {
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            background: #4B5EAA;
            color: #FFFFFF;
            font-family: 'Inter';
            font-size: 14px;
        }

        .footer-links .email-input input::placeholder {
            color: #FFFFFF;
            opacity: 0.7;
        }

        .footer-links .email-input svg {
            width: 20px;
            height: 20px;
            fill: #FFFFFF;
        }
    </style>
</head>
<body>
    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
    @endphp
    <div class="dashboard-page">
        <!-- Navbar -->
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="SwapHub Logo">
                <span class="logo-text">SWAPHUB</span>
            </div>
            <div class="user-profile">
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-black" type="button">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 me-2 rounded-full" src="{{ asset(Auth::user()->profile_picture_users) }}?t={{ time() }}" alt="Profile Picture">
                    {{ $user->full_name }}
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownAvatarName" class="z-10 hidden bg-black divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div class="font-medium">Pro User</div>
                        <div class="truncate">{{ $user->email }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownAvatarNameButton">
                        <li>
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                    </div>
                </div>
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 ml-4">Logout</button>
                </form> --}}
            </div>
        </div>

        <!-- Bottom Bar (Garis Biru di Bawah Navbar) -->
        <div class="bottom-bar"></div>

        <!-- Notifikasi -->
        <div class="notification">
            @if (session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif

            @if (Auth::user()->unreadNotifications->isNotEmpty())
                @foreach (Auth::user()->unreadNotifications as $notification)
                    <div class="unread">
                        <span>{{ $notification->data['message'] }}</span>
                        <a href="{{ $notification->data['url'] }}" onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $notification->id }}').submit();" class="text-white underline">Tandai Dibaca</a>
                        <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notification.read', $notification->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Find your items">
        </div>

        <!-- Categories -->
        <div class="categories">
            <div class="category-item" data-kategori="Gadget">
                <img src="{{ asset('images/mac-book-air.png') }}" alt="Gadget">
                <span>Gadget</span>
            </div>
            <div class="category-item" data-kategori="Otomotif">
                <img src="{{ asset('images/motorbike-helmet.png') }}" alt="Otomotif">
                <span>Otomotif</span>
            </div>
            <div class="category-item" data-kategori="Administrasi">
                <img src="{{ asset('images/book-and-pencil.png') }}" alt="Administrasi">
                <span>Administrasi</span>
            </div>
            <div class="category-item" data-kategori="Pakaian">
                <img src="{{ asset('images/hanger.png') }}" alt="Pakaian">
                <span>Pakaian</span>
            </div>
            <div class="category-item" data-kategori="Mainan">
                <img src="{{ asset('images/plush.png') }}" alt="Mainan">
                <span>Mainan</span>
            </div>
            <div class="category-item" data-kategori="Olahraga">
                <img src="{{ asset('images/tennis.png') }}" alt="Olahraga">
                <span>Olahraga</span>
            </div>
            <div class="category-item" data-kategori="Furniture">
                <img src="{{ asset('images/sofa.png') }}" alt="Furniture">
                <span>Furniture</span>
            </div>
            <div class="category-item" data-kategori="Aksesoris">
                <img src="{{ asset('images/necklace.png') }}" alt="Aksesoris">
                <span>Aksesoris</span>
            </div>
        </div>

        <!-- Tombol Tambah Barang dan Lihat Permintaan Tukar -->
        @if (!Auth::user()->is_admin)
            <div class="action-buttons">
                <a href="{{ route('barang.create') }}" class="tambah">Tambah Barang</a>
                <a href="{{ route('penukaran.index') }}" class="permintaan">Lihat Permintaan Tukar</a>
            </div>
        @endif

        <!-- Just For You Section (Hanya untuk Admin) -->
        @if (Auth::user()->is_admin)
            <div class="just-for-you">
                <h2 class="section-title">Just For You</h2>
                <p class="section-subtitle">Mungkin ada barang kamu inginkan?</p>
                @if ($barang->isEmpty())
                    <p class="text-gray-600 mb-12">Tidak ada barang yang tersedia.</p>
                @else
                    <div class="item-grid">
                        @foreach ($barang as $item)
                            <div class="item-card">
                                <div class="h-48 bg-gray-200 flex items-center justify-center">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-500">Gambar Tidak Tersedia</span>
                                    @endif
                                </div>
                                <div class="details">
                                    <p class="description">{{ $item->deskripsi_barang }}</p>
                                    <a href="{{ route('barang.show', $item->id_barang) }}">Lihat</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <!-- Daftar Barang Section -->
        <div class="daftar-barang">
            <h2 class="section-title">Daftar Barang</h2>
            <p class="section-subtitle">Apa yang lagi dicari hari ini?</p>
            <div id="item-grid-container">
                @if ($barang->isEmpty())
                    <p class="text-gray-600 mb-12">Tidak ada barang yang tersedia.</p>
                @else
                    <div class="item-grid">
                        @foreach ($barang as $item)
                            <div class="item-card">
                                <div class="h-48 bg-gray-200 flex items-center justify-center">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gray-500">Gambar Tidak Tersedia</span>
                                    @endif
                                </div>
                                <div class="details">
                                    <p class="description">{{ $item->deskripsi_barang }}</p>
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('barang.show', $item->id_barang) }}">Lihat</a>
                                        @if (Auth::user()->id == $item->id_user && $item->status_barang != 'ditukar')
                                            <a href="{{ route('barang.edit', $item->id_barang) }}" class="edit">Edit</a>
                                            <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="slogan">"SwapHub - Swap, Use, Save, Sustain!"</p>
            <div class="footer-links">
                <div>
                    <div class="logo">
                        <img src="{{ asset('images/SWAPHUBLOGO.png') }}" alt="SwapHub Logo">
                        <span class="logo-text">SWAPHUB</span>
                    </div>
                    <p style="font-size: 14px; margin-top: 10px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Copyright © 2020 Landify UI Kit.<br>All rights reserved</p>
                </div>
                <div>
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Help center</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Legal</a></li>
                        <li><a href="#">Privacy policy</a></li>
                        <li><a href="#">Status</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Stay up to date</h4>
                    <ul>
                        <li><a href="#">Newsletter</a></li>
                        <li><a href="#">Buletin</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
            const categoryItems = document.querySelectorAll('.category-item');
            const itemGridContainer = document.getElementById('item-grid-container');

            categoryItems.forEach(item => {
                item.addEventListener('click', function () {
                    // Hapus class 'selected' dari semua kategori
                    categoryItems.forEach(i => i.classList.remove('selected'));
                    // Tambahkan class 'selected' pada kategori yang diklik
                    this.classList.add('selected');

                    const kategori = this.getAttribute('data-kategori');

                    // Kirim permintaan AJAX untuk memfilter barang
                    fetch(`/barang/filter?kategori=${kategori}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Kosongkan container sebelumnya
                        itemGridContainer.innerHTML = '';
                        
                        if (data.barang.length === 0) {
                            itemGridContainer.innerHTML = '<p class="text-gray-600 mb-12">Tidak ada barang yang tersedia.</p>';
                        } else {
                            const itemGrid = document.createElement('div');
                            itemGrid.classList.add('item-grid');

                            data.barang.forEach(item => {
                                const itemCard = document.createElement('div');
                                itemCard.classList.add('item-card');
                                itemCard.innerHTML = `
                                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                                        ${item.gambar ? `<img src="/storage/${item.gambar}" alt="${item.nama_barang}" class="w-full h-full object-cover">` : '<span class="text-gray-500">Gambar Tidak Tersedia</span>'}
                                    </div>
                                    <div class="details">
                                        <p class="description">${item.deskripsi_barang || 'Deskripsi tidak tersedia'}</p>
                                        <div class="flex justify-center gap-2">
                                            <a href="/barang/${item.id_barang}">Lihat</a>
                                            ${data.is_owner && item.status_barang !== 'ditukar' ? `
                                                <a href="/barang/${item.id_barang}/edit" class="edit">Edit</a>
                                                <form action="/barang/${item.id_barang}" method="POST" class="inline">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                                                </form>
                                            ` : ''}
                                        </div>
                                    </div>
                                `;
                                itemGrid.appendChild(itemCard);
                            });

                            itemGridContainer.appendChild(itemGrid);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        itemGridContainer.innerHTML = '<p class="text-red-600 mb-12">Terjadi kesalahan saat memuat data.</p>';
                    });
                });
            });
        });
    </script>
</body>
</html>