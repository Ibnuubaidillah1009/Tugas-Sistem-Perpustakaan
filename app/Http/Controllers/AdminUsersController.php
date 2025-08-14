<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminUsersController extends Controller
{
    /**
     * Tampilkan daftar user dan status online.
     */
    public function index()
    {
        $users = User::query()->orderBy('name')->get();

        // Tentukan status online via cache key (ditetapkan oleh middleware nanti)
        $onlineIds = [];
        foreach ($users as $u) {
            $onlineIds[$u->id] = Cache::has('user-is-online-' . $u->id);
        }

        return view('admin.users.index', compact('users', 'onlineIds'));
    }

    /**
     * Hapus user (hanya admin).
     */
    public function destroy($id)
    {
        if ((int) auth()->id() === (int) $id) {
            return back()->with('error', 'Tidak bisa menghapus diri sendiri.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
