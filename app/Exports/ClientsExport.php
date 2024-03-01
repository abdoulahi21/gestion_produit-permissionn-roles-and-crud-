<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Client::select("id", "nom", "prenom","adresse","numeroTelephone","sexe")->get();
    }
    public function headings(): array
    {
        return ["ID", "Nom", "Prenom", "Adresse", "NumeroTelephone", "Sexe"];
    }
}
