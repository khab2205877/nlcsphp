<?php
 
 namespace App\Controllers\User;

 class Productlist extends Controller
 {
     public function productlist()
     {
         $this->sendPage('pages/productlist');
     }
 }