<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductImages;
use Livewire\WithFileUploads;

class AddProductComponent extends Component
{
    use WithFileUploads;

    public $title,$price,$images=[];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'title' => 'required',
            'price'=>'required',
            'images.*' => 'image|max:1024'
        ]);
    }

     public function storeProduct(){
         $validatedData= $this->validate([
            'title' => 'required',
            'price' => 'required',
            'images.*' => 'image|max:1024'
        ]);

        //product insert
        $product = new Product();
        $product->title = $this->title;
        $product->price = $this->price;
        $product->status =1;
        $product->save();

       //product multiple image insert

        foreach($this->images as $key=>$image){
            $productImage = new ProductImages();
            $productImage->product_id = $product->id;
            $imageName = time().$key.'.'.$this->images[$key]->extension();
            $this->images[$key]->storeAs('all', $imageName);
            $productImage->image =  $imageName;
            $productImage->save();
        }
        session()->flash('message', 'A New Product Has Added Succesfully');
        return redirect()->route('list.products');
    }



    public function render()
    {
        return view('livewire.add-product-component');
    }
}
