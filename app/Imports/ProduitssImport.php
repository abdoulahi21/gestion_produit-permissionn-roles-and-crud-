<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProduitssImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'nom'     => $row['nom'],
            'description'    => $row['description'],
            'prix'    => $row['prix'],
            'quantite'    => $row['quantite'],
            'photo'    => $row['photo'],
            'categories_id'    => $row['categories_id'],


        ]);
    }
}
