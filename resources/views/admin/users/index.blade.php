<h1>Users Admin panel</h1>
<ul>
@forelse($users as $user)

        <li>{{$user->name}}</li>
@empty
            <li>No users found</li>
@endforelse
</ul>

