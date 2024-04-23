<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
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

class ProductUpdateController extends Controller
{
    public function edit($id)
    {   
        if (auth()->user()->role === 'admin')
        {
        // Fetch the product by ID
        $product = Product::find($id);

        // Fetch other related models
        $processor = Processor::where('processor_product_id', $id)->first();
        $motherboard = Motherboard::where('motherboard_product_id', $id)->first();
        $ram = Ram::where('ram_product_id', $id)->first();
        $gpu = Gpu::where('gpu_product_id', $id)->first();
        $computercase = ComputerCase::where('case_product_id', $id)->first();
        $storage = Storage::where('storage_product_id', $id)->first();
        $monitor = Monitor::where('monitor_product_id', $id)->first();
        $accessories = Accessories::where('acce_product_id', $id)->first();

        return view('product_update', compact('product', 'processor', 'motherboard','ram','gpu','computercase','storage','monitor','accessories'));
        }
        else
        {
            return redirect()->route('welcome');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedProductData = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'warranty' => 'nullable|string|max:255',
        ]);

        $product = Product::find($id);
        $product->update($validatedProductData);

        if ($processor = Processor::where('processor_product_id', $id)->first()) {
            $validatedProcessorData = $request->validate([
                'gen' => 'required|string|max:255',
                'core' => 'required|string|max:255',
                'socket' => 'required|string|max:255',
            ]);
            $processor->update($validatedProcessorData);
        }
        
        if ($motherboard = Motherboard::where('motherboard_product_id', $id)->first()) {
            $validatedmotherboardData = $request->validate([
                'gen' => 'required|string|max:255',
                'processor' => 'required|string|max:255',
                'socket' => 'required|string|max:255',
                'ramtype' => 'required|string|max:255',

            ]);
            $motherboard->update($validatedmotherboardData);
        }
        if ($ram = Ram::where('ram_product_id', $id)->first()) {
            $validatedramData = $request->validate([
                'capacity' => 'required|string|max:255',
                'ramtype' => 'required|string|max:255',
                'speed' => 'required|string|max:255',
            ]);
            $ram->update($validatedramData);
        }
        if ($gpu = Gpu::where('gpu_product_id', $id)->first()) {
            $validatedgpuData = $request->validate([
                'chipset' => 'required|string|max:255',
                'memory' => 'required|string|max:255',
            ]);
            $gpu->update($validatedgpuData);
        }
        if ($computercase = ComputerCase::where('case_product_id', $id)->first()) {
            $validatedcomputercaseData = $request->validate([
                'color' => 'required|string|max:255',
            ]);
            $computercase->update($validatedcomputercaseData);
        }
        if ($storage = Storage::where('storage_product_id', $id)->first()) {
            $validatedstorageData = $request->validate([
                'interface' => 'required|string|max:255',
                'capacity' => 'required|string|max:255',
            ]);
            $storage->update($validatedstorageData);
        }
        if ($monitor = Monitor::where('monitor_product_id', $id)->first()) {
            $validatedmonitorData = $request->validate([
                'size' => 'required|string|max:255',
                'panel' => 'required|string|max:255',
                'rate' => 'required|string|max:255',
                'resolution' => 'required|string|max:255',

            ]);
            $monitor->update($validatedmonitorData);
        }
        return redirect()->route('product_update', ['id' => $id])->with('success', 'Product updated successfully');
    }
    public function delete($id): RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product deleted successfully');
    }
}
