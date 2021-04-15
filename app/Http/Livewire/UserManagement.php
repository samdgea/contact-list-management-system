<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    public $roles, $user_id, $user_role, $name, $email, $password;
    public $viewModal = false;


    public function render()
    {
        $this->roles = Role::get();
        return view('livewire.user.index', [
            'users' => User::orderBy('created_at', 'DESC')->paginate(10)
        ]);
    }


    public function create() {
        $this->_resetFields();
        $this->openModal();
    }

    public function store() {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6'
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user = User::updateOrCreate(['id' => $this->user_id], $data);
        $user->syncRoles([$this->user_role]);

        session()->flash('message', $this->user_id ? $this->name . ' telah di update' : 'User baru berhasil ditambahkan');
        $this->closeModal();
        $this->_resetFields();
    }

    public function edit($id) {
        $user = User::find($id);

        $this->user_id = $id;
        $this->name  = $user->name;
        $this->email = $user->email;
        $this->user_role = $user->getRoleNames()->first();

        $this->openModal();
    }

    public function delete($id) {
        $user = User::find($id);

        if (!empty($user)) {
            $user->delete();
            session()->flash('message', 'User ' . $user->name . ' berhasil dihapus');
        } else {
            session()->flash('message', 'User tidak ditemukan, kemungkinan telah dihapus.');
        }
    }

    public function openModal() {
        $this->viewModal = true;
    }

    public function closeModal() {
        $this->_resetFields();
        $this->viewModal = false;
    }

    private function _resetFields() {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->user_role = null;
    }
}
