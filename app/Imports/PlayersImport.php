<?php

namespace App\Imports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlayersImport implements ToModel, WithHeadingRow
{
    public $data;

    public function __construct()
    {
        $this->data = collect();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
//        return new Player([
//            'name' => $row['name'],
//            'club' => $row['club'],
//            'email' => $row['email'],
//            'position' => $row['position'],
//            'age' => $row['age'],
//            'salary' => $row['salary']
//        ]);
        //return an eloquent object
        $model = Player::firstOrCreate([ //tim ban ghi dau tien ko co se tao moi
            'name' => $row['name'],
        ], [
            'club' => $row['club'],
            'email' => $row['email'],
            'position' => $row['position'],
            'age' => $row['age'],
            'salary' => $row['salary']
        ]);
        $this->data->push($model);
        return $model;
    }
}
