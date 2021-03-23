<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Adver\ExpertAdvController;
use Illuminate\Http\Request;

class InvoiceController extends ExpertAdvController
{
    private $expert;
    private $price;

    public function __construct(array $price , $expert)
    {
        $this->price = $price;
        $this->expert = $expert;
    }



}
