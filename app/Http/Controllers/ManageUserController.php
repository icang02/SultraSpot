<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ManageUserController extends Controller
{
    public function index(Role $role)
    {
        if ($role->id == 1) $title = 'Admin';
        if ($role->id == 2) $title = 'Pengunjung';
        if ($role->id == 3) $title = 'Pengelola';

        $data = $role->users->chunk($role->users->count());

        return Inertia::render('Dashboard/Admin/UsersIndex', [
            'title' => $title,
            'roles' => $role->users,
            'data' => $data,
        ]);
    }

    public function edit($role, User $user)
    {
        return Inertia::render('Dashboard/Admin/UserDetail', [
            'title' => $role,
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->role_id == 1) $link = 'admin';
        if ($user->role_id == 2) $link = 'pengunjung';
        if ($user->role_id == 3) $link = 'pengelola';

        // Rules validate data
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns',
            'role_id' => 'required',
        ];

        // Message display to screen
        $rulemessages = [
            'name.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah pernah digunakan.',
            'role_id.required' => 'Kolom role wajib diisi.',
        ];

        // Check email is unique
        if ($request->email !== $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        // Check validate and insert data
        $validatedData = $request->validate($rules, $rulemessages);

        $user->update([
            'name' => Str::title($request->name),
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect("users/$link")->with('success', 'Akun berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        // dd($user);
        if ($user->role_id == 1) $link = 'admin';
        if ($user->role_id == 2) $link = 'pengunjung';
        if ($user->role_id == 3) $link = 'pengelola';

        User::destroy($user->id);
        return redirect("users/$link");
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);

        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns',
        ];

        if ($request->file('image_profil') == null) {
            $imgName = $user->image_profil;
        } else {
            $rules['image_profil'] = 'image|mimes:jpg,png,jpeg|max:1024';
        }
        $validatedData = $request->validate($rules);

        if ($request->file('image_profil') != null) {
            $imgName = cloudinary()->upload($request->file('image_profil')->getRealPath(), [
                'folder' => 'avatars'
            ])->getSecurePath();
            $imgPublicId = cloudinary()->getPublicId($imgName);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image_profil' => $imgName,
            'image_public_id' => $imgPublicId,
        ]);
    }
}
