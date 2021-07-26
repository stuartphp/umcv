<select {{ $attributes->merge(['class' => 'form-control form-control-sm']) }} wire:model="pageSize" >
    <option value="10">10</option>
    <option value="15">15</option>
    <option value="20">20</option>
    <option value="50">50</option>
</select>
