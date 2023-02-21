<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(
                User::query()->where('role', '!=', 'superadmin')->latest()
            )
            ->editColumn('photo', function (User $user) {
                if (!$user->photo) {
                    return '
                        <img
                            src="https://via.placeholder.com/40"
                            class="img-fluid"
                            style="width: 40px; heigt: 40px; border-radius: 5px;"
                        />
                    ';
                }

                return '
                    <img
                        src="' . Storage::disk('public')->url($user->photo) . '"
                        class="img-fluid"
                        style="width: 40px; heigt: 40px; border-radius: 5px;"
                    />
                ';
            })
            ->addColumn('action', function (User $user) {
                return '
                    <a href="' . route('user.edit', $user->id) . '" type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-pen"></i>
                    </a>
                    <form onsubmit="destroy(event)" class="d-inline-block" action="' . route('user.destroy', $user->id) . '" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->addIndexColumn()
            ->editColumn('status', function ($user) {
                if ($user->status === "active") {
                    return '<span class="badge badge-success p-2">Active</span>';
                }

                return '<span class="badge badge-danger p-2">Blocked</span>';
            })
            ->escapeColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        return view('user.index');
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:active,blocked',
        ]);

        $image = $request->file('images');

        if ($image) {
            $hashName = $image->hashName();
            $image->storeAs('public', $hashName);

            $validatedData = array_merge($validatedData, [
                'photo' => $hashName
            ]);
        }

        $user->update($validatedData);

        return redirect()->route('user.index')->with('success', 'User Update Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ]);
    }
}
