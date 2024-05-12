@if(auth()->user()->canAny(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol', 'ver-estudiante', 'crear-estudiante', 'editar-estudiante', 'borrar-estudiante', 'ver-grupos', 'ver-materias']))
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}" style="background-color: #D5EDF9;">
    @canany(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol'])
    <li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/home">
            <i class="fas fa-building text-primary mr-2"></i><span class="menu-text">Dashboard</span>
        </a>
    </li>
    <li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/usuarios">
            <i class="fas fa-users text-success mr-2"></i><span class="menu-text">Usuarios</span>
        </a>
    </li>
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/roles">
            <i class="fas fa-user-lock text-warning mr-2"></i><span class="menu-text">Roles</span>
        </a>
    </li>
    @endcanany
    @can(['ver-estudiante', 'crear-estudiante', 'editar-estudiante', 'borrar-estudiante'])
    <li class="{{ Request::is('estudiantes*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/estudiantes">
            <i class="fas fa-user-graduate text-info mr-2"></i><span class="menu-text">Estudiantes</span>
        </a>
    </li>
    @endcan
    @can('ver-inscripcion')
    <li class="{{ Request::is('inscripciones*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/inscripciones">
            <i class="fas fa-user-graduate text-danger mr-2"></i><span class="menu-text">Inscribir Estudiante</span>
        </a>
    </li>
    @endcan
    @can('ver-grupos')
    <li class="{{ Request::is('grupos') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/grupos">
            <i class="fas fa-users text-secondary mr-2"></i><span class="menu-text">Grupos</span>
        </a>
    </li>
    @endcan
    @can('ver-materias')
    <li class="{{ Request::is('materias') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/logss">
            <i class="fas fa-book text-primary mr-2"></i><span class="menu-text">Materias</span>
        </a>
    </li>
    @endcan
    @can('ver-logs')
    <li class="{{ Request::is('logs') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/logss">
            <i class="fas fa-building text-primary mr-2"></i><span class="menu-text">Logs</span>
        </a>
    </li>
    @endcan
</ul>
@endif