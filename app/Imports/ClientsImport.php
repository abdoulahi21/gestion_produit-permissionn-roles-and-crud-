<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Client([
            'nom'     => $row['nom'],
            'prenom'    => $row['prenom'],
            'adresse'    => $row['adresse'],
            'numeroTelephone'    => $row['numerotelephone'],
            'sexe'    => $row['sexe'],
        ]);
    }
}
