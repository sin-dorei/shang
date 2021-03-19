<div class="list-group-item">
  <img class="mr-3" src="{{ $user->gravatar('32') }}" alt="{{ $user->name }}">
  <a href="{{ route('user.show', $user) }}">
    {{ $user->name }}
  </a>
</div>
