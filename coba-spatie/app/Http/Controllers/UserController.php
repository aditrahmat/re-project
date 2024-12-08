<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna dari database
        return view('admin/users/index', compact('users'));
    }

    /**
     * Menampilkan detail pengguna tertentu.
     */
    public function show($id)
    {
        $users = User::findOrFail($id); // Cari user berdasarkan ID, error jika tidak ditemukan
        return view('admin.users.show', compact('users'));
    }

    /**
     * Menampilkan form untuk mengedit data pengguna.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil data user berdasarkan ID
        $roles = Role::all(); // Ambil semua role dari database

        return view('admin.users.edit', compact('user', 'roles')); // Kirim ke view
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Pastikan email unik kecuali untuk user yang sedang diedit
            'password' => 'nullable|string|min:8', // Password opsional
            'level' => 'required|exists:roles,name' // Level harus sesuai dengan role yang ada
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, perbarui password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save(); // Simpan data user

        // Perbarui role/level
        $user->syncRoles([$request->level]); // Sinkronkan role dengan input level

        // Redirect dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Temukan user berdasarkan ID

        // Pastikan admin tidak menghapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        // Hapus user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
