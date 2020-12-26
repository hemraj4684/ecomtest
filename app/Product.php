<?php

namespace App;
use Validator, Schema, Storage, File;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $columns = [];

    protected $rules = [
        'amount'        => 'required|numeric|min:1',
        'image_path' => 'mimes:jpeg,png',
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function validateProduct(array $data)
    {

    	return  Validator::make($data, $this->rules);

    }

    public function saveProduct(array $data, $id=null)
    {
    	//get all columns of current model
        
        $columns = Schema::getColumnListing($this->table);
        
/****** automate save process getting all column names and text box name and save textbox value in columns ******/
    	foreach ($data as $key => $value) {
    		if(in_array($key, $columns)){
    			$this->$key = $value;
    		}
        }

        $cover = $data['image_path'];
        $extension = $cover->getClientOriginalExtension();
        $this->image_path = $cover->getFilename().'.'.$extension;
        Storage::disk('public')->put($cover->getFilename().'.'.$extension,  File::get($cover));
    	return $this->save();
    }

    
}
