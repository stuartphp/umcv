<div>
   
    <div class="row">
        <div class="col-lg-4">

            <!-- Default Card Example -->
            <div class="card mb-4">

                <div class="card-body">
                    @if (auth()->user()->profile_image>'')
                        <img src="/storage/{{ auth()->user()->profile_image }}" style="max-width: 300px"/>
                    @endif
                    <form wire:submit.prevent="save">
                        <x-inp type="file" wire:model="photo"/>

                        @error('photo') <span class="error">{{ $message }}</span> @enderror

                        <button type="submit" class="mt-3 btn btn-light btn-icon-split">
                            <span class="icon text-gray-600">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Upload</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <x-label value="Name"/>
                            <x-inp type="text" wire:model.defer="item.name"/>
                            <x-label value="Password"/>
                            <x-inp type="password" wire:model.defer="item.password"/>
                        </div>
                        <div class="col-6">
                            <x-label value="Email"/>
                            <x-inp type="email" wire:model.defer="item.email"/>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-sm" wire:click="updateUser">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
