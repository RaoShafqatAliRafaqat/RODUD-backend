<div>
    <h4>Notifications</h4>
    <ul>
        @forelse($notifications as $notification)
            <li>
                <strong>{{ $notification->data['message'] }}</strong><br>
                Location: {{ $notification->data['location'] }}<br>
                Pickup Time: {{ $notification->data['pickup_time'] }}
            </li>
        @empty
            <li>No notifications</li>
        @endforelse
    </ul>
</div>
