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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect(route('admin.index'));
    }

    /**
     * Search for Admin Record for Authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function search_admins()
    {
        $admins = User::where('user_level', 'admin')->latest()->filter(request(['search']))->get();

        $renderedAdmins = '';
        foreach ($admins as $admin) {
            $renderedAdmins .= view('partials.admin-data', ['admin' => $admin])->render();
        }

        return response()->json(['admins' => $renderedAdmins]);
    }
}
