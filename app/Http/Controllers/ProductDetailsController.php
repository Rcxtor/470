<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Processor;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Gpu;
use App\Models\ComputerCase;
use App\Models\Storage;
use App\Models\Monitor;
use App\Models\Accessories;

class ProductDetailsController extends Controller
{
    public function index ($id)
    {
        $product = Product::find($id);
        
        $processor = Processor::where('processor_product_id', $id)->first();
        $motherboard = Motherboard::where('motherboard_product_id', $id)->first();
        $ram = Ram::where('ram_product_id', $id)->first();
        $gpu = Gpu::where('gpu_product_id', $id)->first();
        $computercase = ComputerCase::where('case_product_id', $id)->first();
        $storage = Storage::where('storage_product_id', $id)->first();
        $monitor = Monitor::where('monitor_product_id', $id)->first();
        $accessories = Accessories::where('acce_product_id', $id)->first();

        return view('productDetails', compact('product', 'processor', 'motherboard','ram','gpu','computercase','storage','monitor','accessories'));
    }
}
