<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
    $users = User::where('status', 0)->get();
    return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
{
   $validateData = $request->validate([
       'firstName' => ['required', 'string', 'max:255'],
       'lastName' => ['required', 'string', 'max:255'], 
       'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       'password' => 'required|min:6',
       'confirmPassword' => 'required|same:password',
       'phone' => ['required', 'string', 'min:10'],
       'address' => ['required', 'string', 'max:255'],
       'role' => ['required'],
       'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
   ]);

    $storagePath = storage_path('app/public/avatars');
   if (!File::exists($storagePath)) {
       File::makeDirectory($storagePath, 0775, true);
   }

   $avatarPath = null;
   if ($request->hasFile('avatar')) {
       $avatar = $request->file('avatar');
       $avatarName = $avatar->getClientOriginalName();
       
        $avatar->move(public_path('storage/avatars'), $avatarName);
       $avatarPath = 'avatars/' . $avatarName;
   }

   $user = new User();
   $user->firstName = $validateData['firstName'];
   $user->lastName = $validateData['lastName'];
   $user->email = $validateData['email'];
   $user->password = Hash::make($validateData['password']);
   $user->phone = $validateData['phone'];
   $user->address = $validateData['address'];
   $user->role = $validateData['role'];
   $user->avatar = $avatarPath;
   $user->save();

   return redirect()->route('admin.users.index')->with('success', 'User created successfully');
}


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'phone' => ['required', 'string', 'min:10'],
            'address' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
        ]);
    
        $user = User::findOrFail($id);
    
         $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
    
         if ($request->hasFile('avatar')) {
             if ($user->avatar && File::exists(public_path('storage/' . $user->avatar))) {
                File::delete(public_path('storage/' . $user->avatar));
            }
    
             $avatar = $request->file('avatar');
            $avatarName = $avatar->getClientOriginalName();
    
             $avatar->move(public_path('storage/avatars'), $avatarName);
            
             $user->avatar = 'avatars/' . $avatarName;
        }
    
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
    

    public function destroy($id)
{
    try {
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully');
            
    } catch (\Exception $e) {
        return redirect()
            ->route('admin.users.index')
            ->with('error', 'Error deleting user: ' . $e->getMessage());
    }
}
}
