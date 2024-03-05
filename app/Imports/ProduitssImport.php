<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProduitssImport implements ToModel, WithHeadingRow,WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Récupérer le fichier photo
        $photo = $row['photo'];
        if ($photo) {
            $photoPath = Storage::disk('public')->putFile('images', new UploadedFile($photo, $photo->getClientOriginalName()));
        } else {
            $photoPath = null;
        }
        return new User([
            'nom'     => $row['nom'],
            'description'    => $row['description'],
            'prix'    => $row['prix'],
            'quantite'    => $row['quantite'],
            'photo'    => $photoPath,
            'categories_id'    => $row['categories_id'],


        ]);
    }
}
