@extends('layouts.app')
@section('content')
<div class="container m-5">
    <h1 class="mt-4 mb-3"> Dashboard</h1>
    
    <form id="searchForm" method="GET" action="{{ url('admin/search-users') }}" class="mb-4">
        <div class="input-group">
            <input type="text" id="searchQuery" name="search" class="form-control" placeholder="Search by name or email" required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="button" class="btn btn-secondary" onclick="clearSearch()">Clear</button>
            </div>
        </div>
    </form>

    <div id="userTable" class="table-responsive">
        @include('admin.partials.userstable', ['users' => $users])
    </div>
</div>

<script>
document.getElementById('searchQuery').addEventListener('input', function(e) {
    fetch(`{{ url('admin/search-users') }}?search=${e.target.value}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('userTable').innerHTML = html;
        });
});

function clearSearch() {
    document.getElementById('searchQuery').value = '';
    fetch(`{{ url('admin/search-users') }}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('userTable').innerHTML = html;
        });
}

</script>
@endsection
