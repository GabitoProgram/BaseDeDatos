<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctoresModel extends Model
{
    protected $table            = 'doctores';
    protected $primaryKey       = 'id_D';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre','especialidad','Email','telefono','horariosConsulta'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;


}
