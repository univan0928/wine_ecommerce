<?php

namespace App\Exports;

use App\Models\Maker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MakersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return Maker::all();
    }

    public function headings() : array
    {
        return ["foreign_maker_id", "en_name", "jp_name", "maker_avatar", "maker_country", "maker_region", "maker_description", "jp_full_name", "maker_phone", "maker_fax", "maker_address", "maker_url", "maker_email", "pdf_maker_place", "maker_place", "updated_at", "created_at", "maker_name", "pdf_maker_name", "maker_rating", "maker_place_2", "maker_place_3"];
    }
}
