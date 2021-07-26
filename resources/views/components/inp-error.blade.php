@props(['for'])

@error($for)
<div class="text-danger">{{ $message }}</div>
@enderror