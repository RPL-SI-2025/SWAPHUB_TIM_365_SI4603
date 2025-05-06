namespace App\Http\Controllers;

use App\Models\LaporanPenipuan;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanPenipuanController extends Controller
{
    public function index()
    {
        $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->get();
        return view('laporan_penipuan.index', compact('laporan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $users = User::where('id', '!=', Auth::user()->id)->get(); // Semua user kecuali pelapor
        return view('laporan_penipuan.create', compact('kategori', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_dilapor' => 'required|exists:users,id',
            'pesan_laporan' => 'required|string|max:1000',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['id_pelapor'] = Auth::user()->id;
        $data['status_laporan'] = 'pending';

        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')->store('foto_bukti', 'public');
        }

        LaporanPenipuan::create($data);

        return redirect()->route('home')->with('success', 'Laporan penipuan telah dikirim!');
    }

    public function show($id)
    {
        $laporan = LaporanPenipuan::with(['kategori', 'pelapor', 'dilapor'])->findOrFail($id);
        return view('laporan_penipuan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporanPenipuan::findOrFail($id);
        if ($laporan->id_pelapor != Auth::user()->id && !Auth::user()->is_admin) {
            return redirect()->route('laporan_penipuan.index')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }
        $kategori = Kategori::all();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('laporan_penipuan.edit', compact('laporan', 'kategori', 'users'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPenipuan::findOrFail($id);
        if ($laporan->id_pelapor != Auth::user()->id && !Auth::user()->is_admin) {
            return redirect()->route('laporan_penipuan.index')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_dilapor' => 'required|exists:users,id',
            'pesan_laporan' => 'required|string|max:1000',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_bukti')) {
            if ($laporan->foto_bukti) {
                Storage::disk('public')->delete($laporan->foto_bukti);
            }
            $data['foto_bukti'] = $request->file('foto_bukti')->store('foto_bukti', 'public');
        }

        $laporan->update($data);

        return redirect()->route('laporan_penipuan.index')->with('success', 'Laporan penipuan telah diperbarui!');
    }

    public function destroy($id)
    {
        $laporan = LaporanPenipuan::findOrFail($id);
        if ($laporan->id_pelapor != Auth::user()->id && !Auth::user()->is_admin) {
            return redirect()->route('laporan_penipuan.index')->with('error', 'Anda tidak memiliki akses untuk menghapus laporan ini.');
        }

        if ($laporan->foto_bukti) {
            Storage::disk('public')->delete($laporan->foto_bukti);
        }

        $laporan->delete();

        return redirect()->route('laporan_penipuan.index')->with('success', 'Laporan penipuan telah dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('laporan_penipuan.index')->with('error', 'Hanya admin yang dapat mengubah status laporan.');
        }

        $laporan = LaporanPenipuan::findOrFail($id);
        $request->validate([
            'status_laporan' => 'required|in:pending,diterima,ditolak',
        ]);

        $laporan->update(['status_laporan' => $request->status_laporan]);

        return redirect()->route('laporan_penipuan.index')->with('success', 'Status laporan telah diperbarui!');
    }
}