<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalsController extends Controller
{   

    // create variable global
    var $data;
    

    // create function construct use data animals
    public function __construct($data = array('0' => 'Kucing' ,'1' => 'Ayam','2' => 'Ikan')){
        $this->data = $data;
    }
    
    // function use get data animals
    public function index($data = array()){
       foreach($this->data as $key => $value){
        echo  $value.'<br>';
       }
    }

    // function use post data animals
    public function store($data = array()){
        array_push($this->data,'Musang');
        echo $this->index();
    }

    // function use update data animals
    public function update($index = 1,$data = 'Burung'){
        $this->data[$index] = $data;
        echo $this->index();
    }

    // function use delete data animals
    public function delete($index = 2){
        unset($this->data[$index]);
        echo $this->index();
    }
}
