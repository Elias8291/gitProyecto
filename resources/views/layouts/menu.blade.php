@if(auth()->user()->canAny(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol', 'ver-estudiante', 'crear-estudiante', 'editar-estudiante', 'borrar-estudiante', 'ver-grupos']))
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @canany(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol'])
    <li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a class="nav-link" href="/home">
            <i class="fas fa-building"></i><span class="menu-text">Dashboard</span>
        </a>
    </li>
    <li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
        <a class="nav-link" href="/usuarios">
            <i class="fas fa-users"></i><span class="menu-text">Usuarios</span>
        </a>
    </li>
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a class="nav-link" href="/roles">
            <i class="fas fa-user-lock"></i><span class="menu-text">Roles</span>
        </a>
    </li>
    @endcanany

    @can(['ver-estudiante', 'crear-estudiante', 'editar-estudiante', 'borrar-estudiante'])
    <li class="{{ Request::is('estudiantes*') ? 'active' : '' }}">
        <a class="nav-link" href="/estudiantes">
            <i class="fas fa-user-graduate"></i><span class="menu-text">Estudiantes</span>
        </a>
    </li>
    @endcan

    <li class="{{ Request::is('inscripciones*') ? 'active' : '' }}">
        <a class="nav-link" href="/inscripciones">
            <i class="fas fa-user-graduate"></i><span class="menu-text">Inscribir Estudiante</span>
        </a>
    </li>

    @can('ver-grupos')
    <li class="{{ Request::is('grupos') ? 'active' : '' }}">
        <a class="nav-link" href="/grupos">
            <i class="fas fa-users"></i><span class="menu-text">Grupos</span>
        </a>
    </li>
    @endcan
</ul>
@endif