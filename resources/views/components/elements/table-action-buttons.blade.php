<div class="btn-group float-right">

    <a href="{{ route($showRoute, $id) }}" class="btn btn-sm btn-default">
        <i class="fa fa-eye mr-1"></i>
        {{ __('admin.info') }}
    </a>

    <a href="{{ route($editRoute, $id) }}" class="btn btn-sm btn-default">
        <i class="fas fa-edit mr-1"></i>
        {{ __('admin.edit') }}
    </a>


    <button class="btn btn-sm btn-default" type="submit" form="delete-{{ $id }}"
        onclick="return confirm('{{ __('admin.are_you_sure') }}')">
        <i class="fas fa-trash mr-1"></i>
        {{ __('admin.delete') }}
    </button>

</div>

<form id="delete-{{ $id }}" action="{{ route($deleteRoute, $id) }}"
    method="POST">
    @csrf
    @method('DELETE')
</form>
