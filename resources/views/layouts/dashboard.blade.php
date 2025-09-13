<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <title>Duralux || Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/vendors.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/daterangepicker.min.css')}}" />
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/theme.min.css')}}" />
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .nxl-navigation {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 1000;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .nxl-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1100;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        main {
            margin-left: 250px;
            /* Adjust based on navigation width */
            margin-top: 60px;
            /* Adjust based on header height */
            padding: 20px;
            min-height: calc(100vh - 60px);
            /* Ensure content takes full height minus header */
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .nxl-navigation {
                left: -250px;
                transition: all 0.3s ease;
            }

            .nxl-navigation.active {
                left: 0;
            }

            main {
                margin-left: 0;
                margin-top: 60px;
            }
        }
    </style>
</head>

<body>
    <nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="index.html" class="b-brand">
                    <img src="{{asset('assets/images/logo-full.png')}}" alt="" class="logo logo-lg" />
                    <img src="{{asset('assets/images/logo-abbr.png')}}" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>

                    @if (Auth::user()->role == 'admin')
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-micon"><img src="{{asset('assets/Svg/user.svg')}}" alt=""></span>
                                <span class="nxl-mtext">Users</span>
                                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{route('admin.users.index')}}">Users
                                        List</a></li>
                            </ul>
                        </li>
                    @endif
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/venue.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Venues</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('venues.create')}}">Add Venue</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{route('venues.index')}}">Venue List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/announcement.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Announcements</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('announcements.create')}}">Add
                                    Announcement</a>
                            </li>
                            @if(auth()->user()->role == 'admin')
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{route('announcements.index')}}">Announcement List</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if (Auth::user()->role=='admin')
                        <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/certificate.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Certificates</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{route('admin.certificates.pending')}}">Pending Certificates</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{route('admin.certificates.approved')}}">Certificates List</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/event.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Events</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('events.create')}}">Add Events</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{route('events.index')}}">Events List</a>
                            </li>
                            @if(auth()->user()->role == 'admin')
                                <li class="nxl-item"><a class="nxl-link" href="{{route('admin.events.index')}}">Pending
                                        Events</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/attendance.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Attendance</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('attendance.index')}}"> Attendance
                                    List</a></li>
                            <li class="nxl-item"><a class="nxl-link"
                                    href="{{route('attendance.user.scanner')}}">Attendance Scanner</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/feedback.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Feedback</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('admin.feedback.index')}}">Feedback
                                    List</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><img src="{{asset('assets/Svg/media.svg')}}" alt=""></span>
                            <span class="nxl-mtext">Media Gallery</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('media-gallery.create')}}">Add Media
                                    Gallery</a>
                            </li>
                            <li class="nxl-item"><a class="nxl-link" href="{{route('media-gallery.index')}}">Media
                                    Gallery List</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left d-flex align-items-center gap-4">
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown nxl-h-item">
                        @php
                            $announcements = app(\App\Http\Controllers\AnnouncementController::class)->fetchForUser();
                        @endphp

                        <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button"
                            data-bs-auto-close="outside">
                            <i class="feather-megaphone">A</i>
                            <span class="badge bg-primary nxl-h-badge">{{ $announcements->count() }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                            <div class="d-flex justify-content-between align-items-center notifications-head">
                                <h6 class="fw-bold text-dark mb-0">Announcements</h6>
                                <a href="{{ route('announcements.all') }}"
                                    class="btn btn-link fs-11 text-success ms-auto p-0">
                                    <i class="feather-list"></i> View All
                                </a>
                            </div>

                            @forelse($announcements as $announcement)
                                <div class="notifications-item">
                                    <i class="feather-megaphone rounded me-3 border p-2 bg-light"></i>
                                    <div class="notifications-desc">
                                        <a href="{{ route('announcements.show', $announcement->id) }}"
                                            class="font-body text-truncate-2-line">
                                            <span class="fw-semibold text-dark">{{ $announcement->title }}</span>
                                            <div class="text-muted">{{ Str::limit($announcement->message, 50) }}</div>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                                {{ $announcement->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center p-3">No announcements</div>
                            @endforelse

                            <div class="text-center notifications-footer">
                                <a href="{{ route('announcements.all') }}" class="fs-13 fw-semibold text-dark">All
                                    Announcements</a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown nxl-h-item">
                        @php
                            $unreadNotifications = auth()->check() ? auth()->user()->unreadNotifications : collect();
                            // dd($unreadNotifications);
                        @endphp


                        <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button"
                            data-bs-auto-close="outside">
                            <i class="feather-bell"></i>
                            <span class="badge bg-danger nxl-h-badge">{{ $unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                            <div class="d-flex justify-content-between align-items-center notifications-head">
                                <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                                <form method="POST" action="{{ route('notifications.readAll') }}">
                                    @csrf
                                    <button class="btn btn-link fs-11 text-success text-end ms-auto p-0">
                                        <i class="feather-check"></i> Mark all as read
                                    </button>
                                </form>
                            </div>

                            @forelse($unreadNotifications as $notification)
                                <div class="notifications-item">
                                    <img src="{{ asset('assets/images/avatar/1.png') }}" alt=""
                                        class="rounded me-3 border" />
                                    <div class="notifications-desc">
                                        <a href="{{ route('events.show', $notification->data['event_id']) }}"
                                            class="font-body text-truncate-2-line">
                                            <span class="fw-semibold text-dark">{{ $notification->data['title'] }}</span>
                                            <span
                                                class="fw-semibold text-{{ $notification->data['status'] == 'pending' ? 'danger' : 'success' }}">{{ $notification->data['status'] }}</span>
                                            {{ $notification->data['message'] }}
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                            <form method="POST"
                                                action="{{ route('notifications.read', $notification->id) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-light">Mark Read</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center p-3">No new notifications</div>
                            @endforelse

                            <div class="text-center notifications-footer">
                                <a href="{{ route('notifications.all') }}" class="fs-13 fw-semibold text-dark">All
                                    Notifications</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside">
                            <img src="{{asset('assets/images/avatar/1.png')}}" alt="user-image"
                                class="img-fluid user-avtar me-0" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('assets/images/avatar/1.png')}}" alt="user-image"
                                        class="img-fluid user-avtar" />
                                    <div>
                                        <h6 class="text-dark mb-0">Alexandra Della <span
                                                class="badge bg-soft-success text-success ms-1">PRO</span></h6>
                                        <span class="fs-12 fw-medium text-muted">alex.della@outlook.com</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="dropdown">
                                    <span class="hstack">
                                        <i
                                            class="wd-10 ht-10 border border-2 border-gray-1 bg-success rounded-circle me-2"></i>
                                        <span>Active</span>
                                    </span>
                                    <i class="feather-chevron-right ms-auto me-0"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-warning rounded-circle me-2"></i>
                                            <span>Always</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-success rounded-circle me-2"></i>
                                            <span>Active</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-danger rounded-circle me-2"></i>
                                            <span>Bussy</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-info rounded-circle me-2"></i>
                                            <span>Inactive</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-dark rounded-circle me-2"></i>
                                            <span>Disabled</span>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-primary rounded-circle me-2"></i>
                                            <span>Cutomization</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="dropdown">
                                    <span class="hstack">
                                        <i class="feather-dollar-sign me-2"></i>
                                        <span>Subscriptions</span>
                                    </span>
                                    <i class="feather-chevron-right ms-auto me-0"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i class="wd-5 ht-5 bg-gray-500 rounded-circle me-3"></i>
                                            <span>Plan</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i class="wd-5 ht-5 bg-gray-500 rounded-circle me-3"></i>
                                            <span>Billings</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i class="wd-5 ht-5 bg-gray-500 rounded-circle me-3"></i>
                                            <span>Referrals</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i class="wd-5 ht-5 bg-gray-500 rounded-circle me-3"></i>
                                            <span>Payments</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i class="wd-5 ht-5 bg-gray-500 rounded-circle me-3"></i>
                                            <span>Statements</span>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i class="wd-5 ht-5 bg-gray-500 rounded-circle me-3"></i>
                                            <span>Subscriptions</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Profile Details</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-activity"></i>
                                <span>Activity Feed</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-dollar-sign"></i>
                                <span>Billing Details</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-bell"></i>
                                <span>Notifications</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-settings"></i>
                                <span>Account Settings</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="./auth-login-minimal.html" class="dropdown-item">
                                <i class="feather-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="dropdown nxl-h-item">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
{{-- 
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div> --}}
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer class="footer">
        <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
            <span>Copyright ©</span>
            <script>
                document.write(new Date().getFullYear());
            </script>
        </p>
        <div class="d-flex align-items-center gap-4">
            <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
            <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
            <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
        </div>
    </footer>
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/daterangepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/circle-progress.min.js')}}"></script>
    <script src="{{asset('assets/js/common-init.min.js')}}"></script>
    <script src="{{asset('assets/js/dashboard-init.min.js')}}"></script>
    <script src="{{asset('assets/js/theme-customizer-init.min.js')}}"></script>
</body>

</html>