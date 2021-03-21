<a href="{{ route('users.followings', $user) }}">
  <strong id="following" class="stat">
    {{ $user->followings()->count() }}
  </strong>
  关注
</a>
<a href="{{ route('users.followers', $user) }}">
  <strong id="followers" class="stat">
    {{ $user->followers()->count() }}
  </strong>
  粉丝
</a>
<a href="{{ route('user.show', $user) }}">
  <strong id="statuses" class="stat">
    {{ $user->statuses()->count() }}
  </strong>
  微博
</a>
