<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Medical Appointments Manager')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            overflow: hidden;
        }

        /* Layout wrapper */
        .layout {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 230px;
            background: #B0C4DE;
            color: #000;
            transition: width 0.3s;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: 72px;
        }

        /* Sidebar scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        /* App header */
        .app-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .app-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .sidebar.collapsed .app-brand span {
            display: none;
        }

        /* Toggle button */
        .toggle-btn {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            color: #000;
            border-radius: 8px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        /* Links */
        .sidebar a {
            color: #000;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Hide text when collapsed */
        .sidebar.collapsed .nav-link span {
            display: none;
        }

        /* Submenus */
        .submenu .nav-link {
            padding-left: 36px;
            font-size: 0.9rem;
        }

        /* Third level indentation */
        .submenu .submenu .nav-link {
            padding-left: 52px;
            font-size: 0.85rem;
        }

        .sidebar.collapsed .submenu {
            display: none;
        }

        /* Content */
        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .topbar {
            position: fixed;
            top: 10px;
            left: 230px;
            /* same as sidebar width */
            z-index: 1050;
            transition: left 0.3s;
        }

        /* Move toggle when sidebar collapses */
        .sidebar.collapsed+.topbar {
            left: 72px;
        }

        .app-brand {
            font-size: 0.95rem;
        }

        .app-brand span {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
            max-width: 160px;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="layout">

        <!-- SIDEBAR -->
        <nav class="sidebar d-flex flex-column p-3" id="sidebar">

            <!-- App header -->
            <div class="app-header">
                <div class="app-brand" data-bs-toggle="tooltip" data-bs-placement="right"
                    title="Medical Appointments Manager">
                    <i class="bi bi-calendar2-check"></i>
                    <span>Medical Appointments Manager</span>
                </div>
            </div>

            <ul class="nav nav-pills flex-column mb-auto">

                <!-- Patients -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#patientsMenu">
                        <i class="bi bi-people"></i>
                        <span>Patients</span>
                    </a>
                    <div class="collapse" id="patientsMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('patients.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('patients.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Appointments -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#appointmentsMenu">
                        <i class="bi bi-calendar-check"></i>
                        <span>Doctors</span>
                    </a>
                    <div class="collapse" id="appointmentsMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('appointments.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('appointments.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Services -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#servicesMenu">
                        <i class="bi bi-heart-pulse"></i>
                        <span>Services</span>
                    </a>
                    <div class="collapse" id="servicesMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('services.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('services.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Doctors -->
                <li>
                    <a class="nav-link" data-bs-toggle="collapse" href="#doctorsMenu">
                        <i class="bi bi-person-badge"></i>
                        <span>Doctors</span>
                    </a>
                    <div class="collapse" id="doctorsMenu">
                        <ul class="nav flex-column submenu">
                            <li>
                                <a class="nav-link" href="{{ route('doctors.index') }}">
                                    <i class="bi bi-list-ul"></i>
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('doctors.create') }}">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Add</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="topbar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        }
    </script>
    @stack('scripts')
</body>

</html>