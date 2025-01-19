<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|delete-user|users-list', ['only' => ['index','show','trashed']]);
        $this->middleware('permission:create-user', ['only' => ['create','store','restore']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy','forceDelete']]);
    }
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(RegisterRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'country'  => $request->country,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Account created successfully');
    }
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $reviews = $user->reviews()->where('reviewable_type', 'Freelancer')->get();

        return view('admin.users.show', compact('user','reviews'));
    }
    public function destroy(User $user)
    {
        if ($user->projects()->exists()||$user->clientProjects()->exists()||$user->contracts()->exists()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Cannot delete user that has associated projects');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'user deleted successfully');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()
            ->route('users.trashed')
            ->with('success', 'user restored successfully');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(20);
        return view('admin.users.trashed', compact('users'));
    }
    public function forceDelete($id){
        User::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('success','User deleted successfully');
    }

}
