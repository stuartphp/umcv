<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;
    public $item;
    public $photo;

    public function mount()
    {
        $this->item['name'] = auth()->user()->name;
        $this->item['email'] = auth()->user()->email;
        $this->item['password']='';
        $this->profile_image = auth()->user()->profile_image;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:3072', // 2MB Max
        ]);
        $this->photo->store('/', ['disk'=>'public']);
        $usr = User::findOrFail(auth()->id());
        if($usr->profile_image>'')
        {
            @unlink(public_path('/storage/'.$usr->profile_image));
        }
        $usr->profile_image = $this->photo->hashName();
        $usr->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Image Uploaded']);
        \Auth::setUser($usr);
    }

    public function updateUser()
    {
        $this->validate([
            'item.name'=>'required',
            'item.email'=>'required'
        ]);
        if($this->item['password'] > '')
        {
            $this->item['password'] = bcrypt($this->item['password']);
        }else{
            unset($this->item['password']);
        }
        $usr = User::findOrFail(auth()->id());
        $usr->update($this->item);
        $usr->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Updated']);
        \Auth::setUser($usr);
    }
}
