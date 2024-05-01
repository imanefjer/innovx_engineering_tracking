<div class="card">
    <div class="card-header">
        Profile Information
    </div>
    <div class="card-body">
        <strong>Name:</strong> {{ Auth::user()->name }}<br>
        <strong>Email:</strong> {{ Auth::user()->email }}<br>
        <strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}
    </div>
</div>
