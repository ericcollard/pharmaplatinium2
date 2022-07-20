<td class="table-action">
    <a href="{{ route('brand.show',$id) }}" class="action-icon"> <i class="mdi mdi-magnify"></i></a>
    <a href="{{ route('brand.edit',$id) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
    <form id="delete-{{ $id }}" method="POST" action="{{ route('brand.destroy',$id) }}" class="d-sm-inline-block action-icon">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a href="javascript:{}" onclick="document.getElementById('delete-{{ $id }}').submit(); return false;" style="color: inherit;"><i class="mdi mdi-delete"></i></a>
    </form>
</td>
