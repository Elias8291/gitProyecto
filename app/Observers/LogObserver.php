<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Materia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogObserver
{
    public function created(Model $model)
    {
        $this->log('INSERT', $model);
    }

    public function updated(Model $model)
    {
        $this->log('UPDATE', $model);
    }

    public function deleted(Model $model)
    {
        $this->log('DELETE', $model);
    }

    private function log($action, Model $model)
    {
        $table = $model->getTable();
        $record_id = $model->id;
        $user_name = Auth::user() ? Auth::user()->name : 'Admin'; // Obtener el nombre de usuario actualmente autenticado

        $executedSQL = $this->getExecutedSQL($action, $model);
        $reverseSQL = $this->getReverseSQL($action, $model);

        Log::create([
            'action' => $action,
            'table' => $table,
            'record_id' => $record_id,
            'executedSQL' => $executedSQL,
            'reverseSQL' => $reverseSQL,
            'user_name' => $user_name, // Guardar el nombre de usuario
        ]);
    }

    private function getExecutedSQL($action, $model)
    {
        $table = $model->getTable();
        $record_id = $model->id;
        $attributes = $model->getAttributes();

        if ($action === 'INSERT') {
        // Crear la sentencia SQL para insertar un nuevo registro
            $columns = implode(', ', array_keys($attributes));
            $values = implode("', '", array_values($attributes));
            return "INSERT INTO $table ($columns) VALUES ('$values')";
        } elseif ($action === 'UPDATE') {
        // Crear la sentencia SQL para actualizar un registro existente
            $updates = [];
            foreach ($attributes as $key => $value) {
                $updates[] = "$key = '$value'";
        }
            $updates = implode(', ', $updates);
            return "UPDATE $table SET $updates WHERE id = $record_id";
        } elseif ($action === 'DELETE') {
        // Crear la sentencia SQL para eliminar un registro
            return "DELETE FROM $table WHERE id = $record_id";
        }

        return '';
    }

    private function getReverseSQL($action, $model)
    {
        $table = $model->getTable();
        $record_id = $model->id;
        $attributes = $model->getAttributes();

        if ($action === 'INSERT') {
        // Crear la sentencia SQL inversa para eliminar un registro insertado
            return "DELETE FROM $table WHERE id = $record_id";
        } elseif ($action === 'UPDATE') {
        // Crear la sentencia SQL inversa para revertir una actualización
            $old_values = $model->getOriginal();
            $updates = [];
            foreach ($old_values as $key => $value) {
                $updates[] = "$key = '$value'";
            }
            $updates = implode(', ', $updates);
            return "UPDATE $table SET $updates WHERE id = $record_id";
        } elseif ($action === 'DELETE') {
        // Crear la sentencia SQL inversa para insertar un registro eliminado
            unset($attributes['id']); // Eliminar el ID para evitar conflictos con registros existentes
            $columns = implode(', ', array_keys($attributes));
            $values = implode("', '", array_values($attributes));
            return "INSERT INTO $table ($columns) VALUES ('$values')";
        }

        return '';
    }
}
