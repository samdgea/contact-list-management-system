<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class CustomerManagement extends Component
{
    public $agents, $listAgents;
    public $customer_id, $firstName, $lastName, $emailAddress, $phoneNumber;
    public $viewModal;

    public function render()
    {
        $this->listAgents = User::get()->pluck('name', 'id');

        return view('livewire.customer.index', [
            'customers' => Customer::paginate(10)
        ]);
    }

    public function create() {
        $this->_resetFields();
        $this->openModal();
    }

    public function store() {
        $this->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'nullable|string|max:50',
            'emailAddress' => 'required|email',
            'phoneNumber' => 'required|string|max:20',
            'agents' => 'nullable|array'
        ]);

        $user = Customer::updateOrCreate(['id' => $this->customer_id], [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email_address' => $this->emailAddress,
            'phone_number' => $this->phoneNumber
        ]);

        $user->agents()->detach();

        $us = [];
        foreach($this->agents as $agent) {
            $us[] = User::find($agent);
        }

        $user->agents()->saveMany($us);

        session()->flash('message', $this->customer_id ? 'Customer ' . $user->full_name . ' telah di update' : 'Customer baru berhasil ditambahkan');
        $this->closeModal();
        $this->_resetFields();
    }

    public function edit($id) {
        $cust = Customer::find($id);

        $this->customer_id = $id;
        $this->firstName  = $cust->first_name;
        $this->lastName  = $cust->last_name;
        $this->emailAddress = $cust->email_address;
        $this->phoneNumber = $cust->phone_number;
        $this->agents = $cust->agents->pluck('id');

        $this->openModal();
    }

    public function delete($id) {
        $cust = Customer::find($id);

        if (!empty($cust)) {
            $cust->delete();
            session()->flash('message', 'Customer ' . $cust->full_name . ' berhasil dihapus');
        } else {
            session()->flash('message', 'Customer tidak ditemukan, kemungkinan telah dihapus.');
        }
    }

    public function openModal() {
        $this->viewModal = true;
    }

    public function openAssignModal() {
        $this->assignModal = true;
    }

    public function closeModal() {
        $this->_resetFields();
        $this->viewModal = false;
    }


    private function _resetFields() {
        $this->customer_id = null;
        $this->firstName = null;
        $this->lastName = null;
        $this->emailAddress = null;
        $this->phoneNumber = null;
        $this->agents = null;
    }
}
