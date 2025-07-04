<!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('assets/img/AdminLTELogo.png') }}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
              <span class="brand-text fw-light">
                  Mentoring App
              </span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link @if (Route::currentRouteName() == 'dashboard') active @endif">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              {{-- Admin Sidebar --}}
              @if (Auth::user()->hasRole('admin'))
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link @if (Route::currentRouteName() == 'user.index') active @endif">
                  <i class="nav-icon bi bi-people"></i>
                  <p>
                    Managemen Pengguna
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('mentoring-group.index') }}" class="nav-link @if (Route::currentRouteName() == 'mentoring-group.index') active @endif">
                  <i class="nav-icon bi bi-clipboard-data"></i>
                  <p>
                    Grup Mentoring
                  </p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="{{route('schedule.index')}}" class="nav-link @if (Route::currentRouteName() == 'schedule.index') active @endif">
                  <i class="nav-icon bi bi-calendar-event"></i>
                  <p>
                    Jadwal Mentoring
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('presence.index') }}" class="nav-link @if (Route::currentRouteName() == 'presence.index') active @endif">
                  <i class="nav-icon bi bi-journal-check"></i>
                  <p>
                    Absensi
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('forum.index') }}" class="nav-link @if (Route::currentRouteName() == 'forum.index') active @endif">
                  <i class="nav-icon bi bi-chat-left-text"></i>
                  <p>
                    Forum Diskusi
                  </p>
                </a>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
