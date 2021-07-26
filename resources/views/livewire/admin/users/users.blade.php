<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">{{ __('Users') }}</div>
                <div class="col-md-1">
                    @if (count(array_intersect(session()->get('grant'), ['SU','users_create']))==1)
                    <a href="#" wire:click="showCreateForm">
                        <i class="fa fa-plus"></i></a>
                    @endif
                </div>
                <div class="col-md-1">
                    <x-page-size/>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm" wire:model.debounce.300ms="searchTerm" placeholder="Search" aria-label="Search"/>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th><a href="#" wire:click="sortBy('name')">{{ __('Name') }} <x-icon-sort sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" /></a></th>
                    <th><a href="#" wire:click="sortBy('email')">{{ __('Email') }} <x-icon-sort sortField="email" :sort-by="$sortBy" :sort-asc="$sortAsc" /></a></th>
                    <th>{{ __('Verified') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th class="col-1">{{ __('Action') }}</th>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->email_verified_at }}</td>
                            <td>
                                @foreach ($item->roles as $role )
                                    <span>{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-right">
                                <div class="btn-group drop-left role="group">
                                    <a href="#" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                      <x-icon-three-dots-vertical/>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if (count(array_intersect(session()->get('grant'), ['SU','users_update']))==1)
                                        <li><a class="dropdown-item" href="#" wire:click="showEditForm({{ $item->id }})">Edit</a></li>
                                        @endif
                                        @if (count(array_intersect(session()->get('grant'), ['SU','users_delete']))==1)
                                        <li><a class="dropdown-item" href="#" wire:click="showDeleteForm({{$item->id}})">Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No records found</td></tr>
                    @endforelse
                </tbody>
                <div class="text-right">
                    {{ $data->links() }}
                </div>
            </table>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="deleteForm" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <x-icon-question-stop class="text-danger w-6 h-6" />
                    <div class="ml-3 fs-5">Delete</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-danger btn-sm"
                        wire:click="deleteItem()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="editForm" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <x-icon-pencil-square class="text-warning w-6 h-6" />
                    <div class="ml-3 fs-5">Update</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @include('admin.users.users_form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary btn-sm" wire:click="editItem()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="createForm" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <x-icon-file-plus class="text-info w-6 h-6" />
                    <div class="ml-3 fs-5">Create</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @include('admin.users.users_form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-success btn-sm" wire:click="createItem()">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
