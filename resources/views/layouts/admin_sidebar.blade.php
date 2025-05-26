<div class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-blue-800 to-blue-600 text-white shadow-lg transform transition-all duration-300 ease-in-out z-50" id="sidebar">
    <div class="flex items-center justify-center h-16 border-b border-blue-700">
        <img src="{{ asset('images/SWAPHUB LOGO.png') }}" alt="SwapHub Logo" class="w-10 h-10">
        <h2 class="ml-2 text-xl font-bold">SWAPHUB</h2>
    </div>
    <nav class="mt-6">
        <a href="#" class="flex items-center px-6 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-200 {{ request()->routeIs('home') ? 'bg-blue-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
            Dashboard
        </a>
        <a href="{{ route('users.index') }}" class="flex items-center px-6 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-200 {{ request()->routeIs('users.index') ? 'bg-blue-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
            User
        </a>
        <a href="{{ route('kategori.index') }}" class="flex items-center px-6 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-200 {{ request()->routeIs('kategori.index') ? 'bg-blue-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V4zm2 0h6v14H7V4z"/></svg>
            Kategori
        </a>
        <a href="{{ route('laporan_penipuan.index') }}" class="flex items-center px-6 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-200 {{ request()->routeIs('laporan_penipuan.*') ? 'bg-blue-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
            Laporan
        </a>
        <a href="#" class="flex items-center px-6 py-3 text-gray-200 hover:bg-blue-700 hover:text-white transition duration-200 {{ request()->routeIs('home') ? 'bg-blue-700' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            Rekomendasi
        </a>
    </nav>
    <div class="absolute bottom-0 w-full p-4 text-center text-gray-400 text-sm border-t border-blue-700">
        <p>&copy; 2025 SwapHub. All rights reserved.</p>
    </div>
</div>
<script>
    // Toggle sidebar untuk layar kecil
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
    };
    document.addEventListener('DOMContentLoaded', () => {
        const hamburger = document.createElement('button');
        hamburger.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>';
        hamburger.className = 'fixed top-4 left-4 text-white bg-blue-600 p-2 rounded-lg md:hidden z-50';
        hamburger.addEventListener('click', toggleSidebar);
        document.body.appendChild(hamburger);

        // Tutup sidebar jika klik di luar
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && e.target !== hamburger) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    });
</script>
<style>
    @media (max-width: 768px) {
        #sidebar {
            transform: translateX(-100%);
            height: 100%;
        }
        #sidebar.active {
            transform: translateX(0);
        }
    }
</style>