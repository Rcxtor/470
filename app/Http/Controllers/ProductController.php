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



class ProductController extends Controller
{
    // public function showByCategory($category)
    // {   
    //     $products = Product::where('type', $category)->get();
    //     return view('product', ['products' => $products,'category'=>ucfirst($category)]);
    // }
    // public function filterByBrand(Request $request)
    // {
    //     $selectedBrands = $request->input('brands');
    //     $products = Product::whereIn('brand', $selectedBrands)->get();
    //     return view('product', ['products' => $products]);
    // }
    public function showByCategory(Request $request, $category)
{
    
    $products = Product::all();
    $selectedBrands = $request->input('brands');
    $processors = Processor::all();
    $motherboards = Motherboard::all();
    $rams = Ram::all();
    $gpus = Gpu::all();
    $cases = ComputerCase::all();
    $storages = Storage::all();
    $monitors = Monitor::all();

    $selectedPgen = $request->input('Pgens');
    $selectedPsocket = $request->input('Psocket');
    $selectedMgens = $request->input('Mgens');
    $selectedMsocket = $request->input('Msocket');
    $selectedMram = $request->input('Mram');
    $selectedRram = $request->input('Rram');
    $selectedRcam = $request->input('Rcap');
    $selectedRspeed = $request->input('Rspeed');
    $selectedMonsize = $request->input('Monsize');
    $selectedMonpal = $request->input('Monpal');
    $selectedMonrate = $request->input('Monrate');
    $selectedMonres = $request->input('Monres');
    $selectedSTint = $request->input('STint');
    $selectedSTcap = $request->input('STcap');
    $selectedcolor = $request->input('color');
    $selectedGchip = $request->input('Gchip');
    $selectedGmem = $request->input('Gmem');

    if ($selectedBrands && count($selectedBrands) > 0) {
        // Filter products by selected brands
        $products = Product::whereIn('brand', $selectedBrands)->where('type', $category)->get();
    } 

    // FOR PROCESSOR
    elseif ($selectedPgen && count($selectedPgen) > 0) {
        // Fetch product IDs from Processor table based on selected processor generations
        $processorProductIds = Processor::whereIn('gen', $selectedPgen)->pluck('processor_product_id')->toArray();

        // Filter products by selected processor generations
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedPsocket && count($selectedPsocket) > 0) {
        $processorProductIds = Processor::whereIn('socket', $selectedPsocket)->pluck('processor_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    // FOR MOTHERBOARD
    elseif ($selectedMgens && count($selectedMgens) > 0) {
        $processorProductIds = Motherboard::whereIn('gen', $selectedMgens)->pluck('motherboard_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedMsocket && count($selectedMsocket) > 0) {
        $processorProductIds = Motherboard::whereIn('socket', $selectedMsocket)->pluck('motherboard_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedMram && count($selectedMram) > 0) {
        $processorProductIds = Motherboard::whereIn('ramtype', $selectedMram)->pluck('motherboard_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }

    // FOR RAM
    elseif ($selectedRram && count($selectedRram) > 0) {
        $processorProductIds = Ram::whereIn('ramtype', $selectedRram)->pluck('ram_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedRcam && count($selectedRcam) > 0) {
        $processorProductIds = Ram::whereIn('capacity', $selectedRcam)->pluck('ram_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedRspeed && count($selectedRspeed) > 0) {
        $processorProductIds = Ram::whereIn('speed', $selectedRspeed)->pluck('ram_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }

    // FOR Monitor
    elseif ($selectedMonsize && count($selectedMonsize) > 0) {
        $processorProductIds = Monitor::whereIn('size', $selectedMonsize)->pluck('monitor_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedMonpal && count($selectedMonpal) > 0) {
        $processorProductIds = Monitor::whereIn('panel', $selectedMonpal)->pluck('monitor_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedMonrate && count($selectedMonrate) > 0) {
        $processorProductIds = Monitor::whereIn('rate', $selectedMonrate)->pluck('monitor_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedMonres && count($selectedMonres) > 0) {
        $processorProductIds = Monitor::whereIn('resolution', $selectedMonres)->pluck('monitor_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    // FOR GPU
    elseif ($selectedGchip && count($selectedGchip) > 0) {
        $processorProductIds = Gpu::whereIn('chipset', $selectedGchip)->pluck('gpu_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedGmem && count($selectedGmem) > 0) {
        $processorProductIds = Gpu::whereIn('memory', $selectedGmem)->pluck('gpu_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }

    // FOR STORAGE
    elseif ($selectedSTcap && count($selectedSTcap) > 0) {
        $processorProductIds = Storage::whereIn('capacity', $selectedSTcap)->pluck('storage_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    elseif ($selectedSTint && count($selectedSTint) > 0) {
        $processorProductIds = Storage::whereIn('interface', $selectedSTint)->pluck('storage_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }

    // FOR CASE
    elseif ($selectedcolor && count($selectedcolor) > 0) {
        $processorProductIds = ComputerCase::whereIn('color', $selectedcolor)->pluck('case_product_id')->toArray();
        $products = Product::whereIn('id', $processorProductIds)->where('type', $category)->get();
    }
    

    else {
        // Show all products of the selected category
        $products = Product::where('type', $category)->get();
    }

    return view('product', ['products' => $products,'processors'=>$processors,'motherboards'=>$motherboards,'rams'=>$rams,'gpus'=>$gpus,'cases'=>$cases,'storages'=>$storages,'monitors'=>$monitors, 'category' => ucfirst($category)]);
}
}
