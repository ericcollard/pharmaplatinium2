<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Store a new value for avatar
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function storeAvatar(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'avatar' => ['required', 'image', 'dimensions:max_width=500,max_height=500']
        ]);


        $user->update(
            ['avatar_path' => request()->file('avatar')->storePublicly('', 'avatars')]
        );

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(User $user): RedirectResponse
    {
        //$this->authorize('update',$user);

        $this->validate(request(), [
                'discipline_start' =>  'required|date_format:d/m/Y|',
                'weight' =>  'required',
            ]
        );

        $data = request()->all();
        $data['discipline_start'] = Carbon::createFromFormat('d/m/Y', $data['discipline_start'])->format('Y-m-d');
        if (array_key_exists('email_verified_at',$data) )
        {
            $data['email_verified_at'] = Carbon::createFromFormat('d/m/Y', $data['email_verified_at'])->format('Y-m-d');
        }
        $user->update($data);

        return redirect(route('user.show',['user' => $user]))->with('flash', 'Your profile has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect(route('user.list'));
    }
}
