<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    protected $paginate = 10;
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate($this->paginate);
    }
    /**
     * Return a Json listing of the users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $users = User::select('id','lastName', 'firstName', 'country', 'email', 'address', 'is_admin', 'fund')
        ->orderBy('created_at', 'desc')
        ->get();
        foreach ($users as $user) {
            $user->is_admin = $user->is_admin == 1;
        }
        return response()->json($users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'firstname' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
            'lastname' => ['string', 'nullable'],
            'address' => ['string', 'nullable'],
            'country' => ['string', 'nullable']
        ]);

        if (!array_key_exists('lastname', $fields)) {
            $fields['lastname'] = null;
        }
        if (!array_key_exists('address', $fields)) {
            $fields['address'] = null;
        }
        if (!array_key_exists('country', $fields)) {
            $fields['country'] = null;
        }

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'is_admin' => $fields['is_admin'],
            'address' => $fields['address'],
            'country' => $fields['country']
        ]);

        return response(["id" => $user->id], 201);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id)->toArray();
        if (!$user) {
            return response(['message' => "user with id $id does not exist"], 400);
        }
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response(['message' => "user with id $id is not found"], 400);
        }

        $request->validate([
            'firstname' => ['string'],
            'email' => ['string', 'email', Rule::unique('users')->ignore($user->id)],
            'is_admin' => ['boolean'],
            'lastname' => ['string', 'nullable'],
            'address' => ['string', 'nullable'],
            'country' => ['string', 'nullable']
        ]);

        $user->update($request->all());

        return response([], 204);
    }

    /**
     * Remove the specified database from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response(['message' => "user with id $id is not found"], 400);
        }

        $user->delete();

        return response('', 204);
    }
}
