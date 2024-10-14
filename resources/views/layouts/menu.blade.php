@if(auth()->user()->canAny(['ver-rol', 'ver-usuario', 'ver-log']))
    <li style="height: 50px; background-color: transparent;"></li>
    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    
        @can('ver-dashboard')
        <li class="{{ Request::is('home*') ? 'active' : '' }}" style="margin-bottom: 40px;">
            <a class="nav-link d-flex align-items-center" href="/home" style="padding: 14px 25px; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                <i class="fas fa-building" style="color: #ad0034; margin-right: 12px; font-size: 22px;"></i>
                <span class="menu-text" style="font-weight: 700; color: #006341; letter-spacing: 0.5px; font-family: 'Lato', sans-serif; font-size: 19px;">
                    Dashboard
                </span>
            </a>
        </li>
        @endcan

        {{-- 
        @can('ver-usuario')
        <li class="{{ Request::is('usuarios*') ? 'active' : '' }}" style="margin-bottom: 25px;">
            <a class="nav-link d-flex align-items-center" href="/usuarios" style="padding: 14px 25px; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                <i class="fas fa-users" style="color: #AD0034; margin-right: 12px; font-size: 22px;"></i>
                <span class="menu-text" style="font-weight: 700; color: #AD0034; letter-spacing: 0.5px; font-family: 'Lato', sans-serif; font-size: 19px;">
                    Usuarios
                </span>
            </a>
        </li>
        @endcan
        --}}

        @can('ver-rol')
        <li class="{{ Request::is('roles*') ? 'active' : '' }}" style="margin-bottom: 25px;">
            <a class="nav-link d-flex align-items-center" href="/roles" style="padding: 14px 25px; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                <i class="fas fa-user-lock" style="color: #ad0034; margin-right: 12px; font-size: 22px;"></i>
                <span class="menu-text" style="font-weight: 700; color: #006341; letter-spacing: 0.5px; font-family: 'Lato', sans-serif; font-size: 19px;">
                    Roles
                </span>
            </a>
        </li>
        @endcan

        <li class="{{ Request::is('evaluados*') ? 'active' : '' }}" style="margin-bottom: 25px;">
            <a class="nav-link d-flex align-items-center" href="/evaluados" style="padding: 14px 25px; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                <i class="fas fa-user-lock" style="color: #ad0034; margin-right: 12px; font-size: 22px;"></i>
                <span class="menu-text" style="font-weight: 700; color: #006341; letter-spacing: 0.5px; font-family: 'Lato', sans-serif; font-size: 19px;">
                    Evaluados
                </span>
            </a>
        </li>
       
        {{-- 
        @can('ver-log')
        <li class="{{ Request::is('logs*') ? 'active' : '' }}" style="margin-bottom: 25px;">
            <a class="nav-link d-flex align-items-center" href="/logs" style="padding: 14px 25px; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;">
                <i class="fas fa-file-alt" style="color: #AD0034; margin-right: 12px; font-size: 22px;"></i>
                <span class="menu-text" style="font-weight: 700; color:#AD0034; letter-spacing: 0.5px; font-family: 'Lato', sans-serif; font-size: 19px;">
                    Logs
                </span>
            </a>
        </li>
        @endcan
        --}}
    </li>
@endif
