<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ url('admin/edit-user/'.$user->id) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                <form method="POST" action="{{ url('admin/delete-user/'.$user->id) }}" onsubmit="return confirm('Are you sure? This action cannot be undone!');" class="btn btn-sm btn-danger">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
