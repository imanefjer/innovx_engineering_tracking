@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Notificationnns</h1>
    <ul class="list-group">
        @forelse ($notifications as $notification)
            <li class="list-group-item">
                {!! $notification->message !!} - <small>{{ $notification->notification_date->diffForHumans() }}</small>
                @if($notification->status === 'unread')
                    <form action="{{ route('engineers.notifications.read', $notification->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-info">Mark as Read</button>
                    </form>
                @endif
            </li>
        @empty
            <p>No notifications.</p>
        @endforelse
    </ul>
</div>
@endsection
