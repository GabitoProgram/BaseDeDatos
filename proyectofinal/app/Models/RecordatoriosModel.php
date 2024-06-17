<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordatoriosModel extends Model
{
    protected $table            = 'recordatorios';
    protected $primaryKey       = 'id_R';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_C','tipoRecordatorio','FechaHoraEnvio','Estado'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;

}
