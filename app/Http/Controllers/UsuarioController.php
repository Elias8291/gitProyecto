<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|eliminar-usuario', ['only' => ['index']]);
        $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-usuario', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $searchTerm = $request->get('search');
        $paginationSize = $request->get('size', 15); 

        $usuarios = User::with('area')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            })
            ->paginate($paginationSize);

        return view('usuarios.index', compact('usuarios', 'searchTerm'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $areas = Area::pluck('nombre', 'id')->all(); // Pluck de áreas
        return view('usuarios.crear', compact('roles', 'areas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_area' => 'required|exists:areas,id' // Asegura que el área exista
        ]);

        // Subir imagen si está presente
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'apellido_paterno' => $validatedData['apellido_paterno'],
            'apellido_materno' => $validatedData['apellido_materno'],
            'email' => $validatedData['email'],
            'telefono' => $validatedData['telefono'],
            'password' => Hash::make($validatedData['password']),
            'id_area' => $validatedData['id_area'], // Relacionar el área
            'image' => $validatedData['image'] ?? null,
        ]);

        // Asignar roles
        $user->assignRole($validatedData['roles']);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $areas = Area::pluck('nombre', 'id')->all(); // Obtener las áreas

        return view('usuarios.editar', compact('user', 'roles', 'userRole', 'areas'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_area' => 'required|exists:areas,id' // Validar que el área exista
        ]);

        $user = User::find($id);
        $input = $request->all();

        // Subir nueva imagen si está presente
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        } else {
            $input = Arr::except($input, ['image']);
        }

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
