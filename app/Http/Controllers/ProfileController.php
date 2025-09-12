<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Change this line
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user(); // Change this line
        return view('editprofile', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */ // Add this PHPDoc comment
        $user = Auth::user();

        // Validate form data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Store new image in storage/app/public/profile_images/
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        // Update other fields
        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'] ?? null;
        $user->address = $validated['address'] ?? null;

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

  
}