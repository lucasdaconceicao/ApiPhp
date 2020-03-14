<?php
namespace Pearl\Models;
use Illuminate\Database\Eloquent\Model;
use Pearl\Models\Interfaces\ISerializable;

Class Cidadao extends Model {
    public  $timestamps = false;
    protected $table = 'cidadao';
    protected $guarded = ['id'];
}