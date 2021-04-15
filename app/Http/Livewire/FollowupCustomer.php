<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\HistoryFollowup;
use Livewire\Component;

class FollowupCustomer extends Component
{
    public $viewModal;
    public $customer, $followups;
    public $remarks, $status;
    public function render()
    {
        $customers = Customer::whereHas('agents', function ($q) {
            $q->user_id = \Auth::user()->id;
        })->paginate(10);

        return view('livewire.followup.index', [
            'customers' => $customers
        ]);
    }

    public function view($id) {
        $cust = Customer::find($id);
        $this->customer = $cust;
        $this->remarks = $cust->remarks;
        $this->status = $cust->status;

        if (!empty($this->customer)) {
            $this->followups = HistoryFollowup::with('modifiedby')->where('customer_id', $id)->get();
        }

        $this->openModal();
    }

    public function openModal() {
        $this->viewModal = true;
    }

    public function closeModal() {
        $this->_resetFields();
        $this->viewModal = false;
    }

    private function _resetFields() {
        $this->remarks = null;
        $this->status = null;
        $this->followups = null;
        $this->customer = null;
    }

    public function store()
    {
        $cust = Customer::find($this->customer->id);

        $followup = HistoryFollowup::create([
            'customer_id' => $cust->id,
            'old_status' => $cust->status,
            'new_status' => $this->status,
            'remarks' => $this->remarks
        ]);
        // Add to history
        $cust->followups()->saveMany([
           $followup
        ]);

        $cust->status = $this->status;
        $cust->remarks = $this->remarks;
        $cust->save();

        session()->flash('message', 'Berhasil Ubah status');
        $this->_resetFields();
        $this->closeModal();
    }

}
