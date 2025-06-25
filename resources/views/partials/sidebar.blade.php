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
            @auth
                <span class="brand-text fw-light">
                    Haloo - {{ ucfirst(auth()->user()->role) }}
                </span>
            @else
                <span class="brand-text fw-light">Haloo - Guest</span>
            @endauth
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
                <a href="#" class="nav-link @if (Route::currentRouteName() == 'managemen-pengguna') active @endif">
                  <i class="nav-icon bi bi-people"></i>
                  <p>
                    Managemen Pengguna
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('mentoring.index')}}" class="nav-link @if (Route::currentRouteName() == 'jadwal-mentoring') active @endif">
                  <i class="nav-icon bi bi-calendar-event"></i>
                  <p>
                    Jadwal Mentoring
                  </p>
                </a>
              </li>
              @endif
              @if (Auth::user()->hasRole('mentor'))
              <li class="nav-item">
                <a href="{{route('mentoring.index')}}" class="nav-link @if (Route::currentRouteName() == 'jadwal-mentoring') active @endif">
                  <i class="nav-icon bi bi-calendar-event"></i>
                  <p>
                    Jadwal Mentoring
                  </p>
                </a>
              </li>
              @endif
              @if (Auth::user()->hasRole('user'))
              <li class="nav-item">
                <a href="{{route('schedule.index')}}" class="nav-link @if (Route::currentRouteName() == 'jadwal-user') active @endif">
                  <i class="nav-icon bi bi-calendar-event"></i>
                  <p>
                    Jadwal
                  </p>
                </a>
              </li>
              @endif
              {{-- <li class="nav-item">
                <a href="#" class="nav-link @if (Route::currentRouteName() == 'absensi') active @endif">
                  <i class="nav-icon bi bi-journal-check"></i>
                  <p>
                    Absensi
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link @if (Route::currentRouteName() == 'forum-diskusi') active @endif">
                  <i class="nav-icon bi bi-chat-left-text"></i>
                  <p>
                    Forum Diskusi
                  </p>
                </a>
              </li> --}}
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
