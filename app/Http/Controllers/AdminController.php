<?php

namespace App\Http\Controllers;

use App\Enums\UserLevel;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display all admin level in Users table
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $admins = User::where('user_level', 'admin')->latest()->filter(request(['search']))->get();
        return view('admin.index', ['admins' => $admins]);
    }

    /**
     * Display a form for Creating Admin account
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Save all request from AdminStoreRequest to Admin database
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminStoreRequest $request)
    {
        $admin = $request->all();
        $admin['user_level'] = UserLevel::ADMIN;
        $admin = User::create($admin);

        return redirect(route('admin.index'));
    }

    /**
     * Show form for Editing Admin account
     *
     * @param  mixed $admin
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $admin)
    {
        return view('admin.edit', ['admin' => $admin]);
    }

    /**
     * Update all changes from Edit form then update into database
     *
     * @param  mixed $request
     * @param  mixed $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminUpdateRequest $request, User $admin)
    {
        $admin->update($request->all());
        return redirect(route('admin.index'));
    }

    /**
     * Delete admin account
     *
     * @param  mixed $admin
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function destroy(User $admin)
    {
        // Delete Admin
        $admin->delete();

        // New Fetch Admin Data
        $admins = User::where('user_level', UserLevel::ADMIN)->latest()->get();
        $rendered_admins = '';
        foreach ($admins as $new_admin)
        {
            $rendered_admins .= view('partials.admin-data', ['admin' => $new_admin])->render();
        }

        return response()->json(['admins' => $rendered_admins]);
        // return redirect(route('admin.index'));
    }

    /**
     * Search for Admin Record for Authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_admins()
    {
        $admins = User::where('user_level', UserLevel::ADMIN)->latest()->filter(request(['search']))->get();

        $rendered_admins = '';
        foreach ($admins as $admin) {
            $rendered_admins .= view('partials.admin-data', ['admin' => $admin])->render();
        }

        return response()->json(['admins' => $rendered_admins]);
    }
    
    /**
     * Display all restorable admin deleted
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function restore_index()
    {
        $restorable_admins = User::onlyTrashed()->where('user_level', 'admin')->get();
        return view('admin.restore', ['admins' => $restorable_admins]);
    }
    
    /**
     * Restore the admin
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($admin)
    {
        $admin = User::withTrashed()->find($admin);
        $admin->restore();
        return redirect(route('admin.restore.index'));
    }
}
