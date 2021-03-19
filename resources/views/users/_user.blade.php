<div class="list-group-item">
  <img class="mr-3" src="{{ $user->gravatar('32') }}" alt="{{ $user->name }}">
  <a href="{{ route('user.show', $user) }}">
    {{ $user->name }}
  </a>

  @can('destroy', $user)

  <form method="POST" action="{{ route('user.destroy', $user) }}" class="float-right">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
  </form>

  @endcan

</div>
