<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;


class RegisterController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('usershow', compact('users'));
    }
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        // validation
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone_no' => ['required', 'string', 'max:255'],
            'photograph' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // upload image
        $uploadPath = public_path('uploads');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }
        if ($request->hasFile('photograph')) {
            $file = $request->file('photograph');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $data['photograph'] = 'uploads/' . $filename;
        }

        // password hash
        $data['password'] = bcrypt($data['password']);

        // create user
        User::create($data);

        return redirect()->route('home')->with('success', 'User created successfully.');
    }


    public function show($id)
    {
        //
    }


    public function edit(User $user)
    {
        return view('useredit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        // Validation
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id, // unique but ignore current user
            'phone'      => 'nullable|string|max:20',
            'photograph' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ডাটা আপডেট
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone;

        // যদি নতুন image থাকে
        if ($request->hasFile('photograph')) {
            // পুরানো ছবি ডিলিট (optional)
            if ($user->photograph && file_exists(public_path($user->photograph))) {
                unlink(public_path($user->photograph));
            }

            // নতুন ছবি upload
            $file     = $request->file('photograph');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $user->photograph = 'uploads/' . $filename;
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)
            ->with('success', 'User updated successfully!');
    }



    public function destroy(User $user)
    {
        // delete image
        if ($user->photograph && File::exists(public_path($user->photograph))) {
            File::delete(public_path($user->photograph));
        }

        // delete user
        $user->delete();

        return redirect()->route('home')->with('success', 'User deleted successfully.');
    }
}
