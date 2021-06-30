<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Coa extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    public static function laratablesCustomAction($coa)
    {
        return view('coa.action', ['coa_name' => $coa->coa_name])->render();
    }

    /**
     * Returns the name column value for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomName()
    {
        return view('buttom_html', ['coa_name' => $this->coa_name])->render();

        //	return $coa->coa_name;
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['coa_name'];
    }

    /**
     * first_name column should be used for sorting when name column is selected in Datatables.
     *
     * @return string
     */
    public static function laratablesOrderName()
    {
        return 'coa_name';
    }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param string search term
     * @param \Illuminate\Database\Eloquent\Builder
     */
    public static function laratablesSearchName($query, $searchValue)
    {
        return $query->orWhere('coa_name', 'like', '%' . $searchValue . '%')
            ->orWhere('coa_number', 'like', '%' . $searchValue . '%');
    }

    /**
     * Returns string status from boolean status for the datatables.
     *
     * @return string
     */
    public function laratablesActive($coa)
    {
        //       $coa = Coa::find($this->id);
        //Storage::download('coapath/' . $this->coa_name);

        return $this->active ? 'Active' : 'Inactive';
    }

    /**
     * Specify row class name for datatables.
     *
     * @return string
     */
    public function laratablesRowClass()
    {
        //   $coa = Coa::find($this->id);
        //	Storage::download('coapath/' . $this->coa_name);

        return $this->active ? 'text-success' : '';
    }

    /**
     * Returns the data attribute for row id of the user.
     *
     * @return array
     */
    public function laratablesRowData()
    {
        // Storage::download('coapath/' . $this->coa_name);
        //	dd(Storage::disk('s3'));
        return ['coa_path' => 'https://s3-us-west-1.amazonaws.com/' . $this->coa_name];
        /*
                return [
                        'coa_path' => Storage::disk('s3')
                    ];*/
    }

}
