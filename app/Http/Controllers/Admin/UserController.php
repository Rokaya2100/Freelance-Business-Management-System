<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }
    /**
     * Summary of store
     * @param \App\Http\Requests\RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Summary of show
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $reviews = $user->reviews()->get();
        $portfolio = $user->portfolio;
        $project = $user->freelancerProjects()->get();
        $projectCountfreelancer = $user->freelancerProjects()->count();
        $projectCountclient = $user->clientProjects()->count();
        $reviewscount = $user->reviews()->count();
        return view('admin.users.show', compact('user','reviews','project','portfolio','projectCountfreelancer','projectCountclient','reviewscount'));
    }

    /**
     * Summary of destroy
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
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
    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()
            ->route('users.trashed')
            ->with('success', 'user restored successfully');
    }
    /**
     * Summary of trashed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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
