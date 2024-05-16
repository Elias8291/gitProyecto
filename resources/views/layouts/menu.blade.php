
@if(auth()->user()->canAny(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol', 'ver-estudiante', 'crear-estudiante',
'editar-estudiante', 'borrar-estudiante', 'ver-grupos', 'ver-materias']))
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @canany(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol'])
<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/home">
        <i class="fas fa-building" style="color: #9370DB; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Dashboard</span>
    </a>
</li>
<li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/usuarios">
        <i class="fas fa-users" style="color: #BA55D3; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Usuarios</span>
    </a>
</li>
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/roles">
        <i class="fas fa-user-lock" style="color: #8A2BE2; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Roles</span>
    </a>
</li>
@endcanany

@can(['ver-estudiante'])
<li class="{{ Request::is('estudiantes*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/estudiantes">
        <i class="fas fa-user-graduate" style="color: #20B2AA; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Estudiantes</span>
    </a>
</li>
@endcan

@can('ver-inscripcion')
<li class="{{ Request::is('inscripciones*') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/inscripciones">
        <i class="fas fa-user-edit" style="color: #FFD700; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Inscribir Estudiante</span>
    </a>
</li>
@endcan

@can('ver-grupos')
<li class="{{ Request::is('grupos') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/grupos">
        <i class="fas fa-users" style="color: #FF6347; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Grupos</span>
    </a>
</li>
@endcan

@can('ver-materias')
<li class="{{ Request::is('materias') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/materias">
        <i class="fas fa-book" style="color: #32CD32; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Materias</span>
    </a>
</li>
@endcan

@can('ver-log')
<li class="{{ Request::is('logs') ? 'active' : '' }}">
    <a class="nav-link d-flex align-items-center" href="/logs">
        <i class="fas fa-file-alt" style="color: #FF4500; margin-right: 8px;"></i><span class="menu-text"
            style="font-weight: 600; color: #333;">Logs</span>
    </a>
</li>
@endcan
</ul>
@endif