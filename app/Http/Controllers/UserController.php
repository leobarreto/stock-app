<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {
        return view('users.list');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $this->model->storeUser($request->all());

        return redirect()
        ->route('users.list')
        ->with('msg', 'Usuário cadastrado com sucesso');
    }

    public function list()
    {
        $users = $this->model->get();

        return view('users.list', compact('users'));
    }

    public function edit($id)
    {
        if (!$user = $this->model->find($id)) {
            return redirect()
            ->route('users.list')
            ->with('msg', 'Usuário não encontrado');
        }

        return view('users.edit', compact('user'));
    }

    public function update(StoreUserRequest $request, $id)
    {
        if (!$user = User::find($id)) {
            return redirect()
            ->route('users.list')
            ->with('msg', 'Usuário não encontrado');
        }

        $data = $request->only('name', 'email');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()
        ->route('users.list')
        ->with('msg', 'Usuário atualizado com sucesso');
    }

    public function destroy($id)
    {
        if (!$user = $this->model->find($id)) {
            return redirect()
            ->route('users.list')
            ->with('msg', 'Usuário não encontrado');
        }

        $user->delete();

        return redirect()
        ->route('users.list')
        ->with('msg', 'Usuário excluído com sucesso');
    }
}
