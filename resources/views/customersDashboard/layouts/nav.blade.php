
<div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h3 class="fw-bold mb-0">Overview</h3>
            <h4 class="text-muted small mt-2">Welcome back, <span class="fw-semibold fs-4">{{Auth::user()->first_name ." ". Auth::user()->last_name}}</span></h4>
        </div>
            <div class="d-flex align-items-center">
                <ul class="navbar-nav me-5">
                    <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                        🔔
                        <span class="badge bg-danger">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" style="width:300px;">

                        @foreach(auth()->user()->unreadNotifications as $note)
                            <div class="alert alert-info">
                                <strong>{{ $note->data['title'] }}</strong><br>
                                {{ $note->data['message'] }}
                            </div>
                        @endforeach

                        @if(auth()->user()->unreadNotifications->count() == 0)
                            <div class="dropdown-item text-center">
                                No notifications
                            </div>
                        @endif

                    </div>
                </li>    
                </ul>
                
            <a href="{{ url('/') }}" class="btn btn-success me-5">Visit Site</a>
     
            <div class="dropdown">
               @php
                    $customer = \App\Models\Customer::where('user_id', auth()->id())->first();
                @endphp

                @if ($customer && $customer->profile_image)
                    <img src="{{ asset('storage/' . $customer->profile_image) }}"
                        class="rounded-circle"
                        width="60" height="60">
                @else
                    <img src="https://placehold.co/60x60"
                        class="rounded-circle">
                @endif
                
            </div>
        </div>
    </div>

    