<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Support\Facades\File;

class IndexProductComponent extends Component
{
    public $delete_id;
     protected $listeners = ['deleteConfirmed' => 'deleteProduct'];

    public function delete($id){
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }


    public function deleteProduct(){

        $product = Product::find($this->delete_id);
        if (!is_null($product)) {
            $product->delete();
        }

        //product image delete

        //delete all image
        foreach ($product->images as $img) {
            //delete from path
            $filename = $img->image;
            if (File::exists('uploads/all/' . $filename)) {
                File::delete('uploads/all/' . $filename);
            }
            $img->delete();
        }
        $this->dispatchBrowserEvent('deleteAlert');
    }

    public function render()
    {
        $products = Product::where('status',1)->get();
        return view('livewire.index-product-component',compact('products'));
    }
}
