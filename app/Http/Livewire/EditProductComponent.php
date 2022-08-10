<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductImages;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EditProductComponent extends Component
{
    use WithFileUploads;

    public $title, $price, $images = [];
    public $edit_id;

    public function mount($id)
    {

        $product = Product::find($id);
        $this->title = $product->title;
        $this->price = $product->price;
        $this->edit_id = $id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'title' => 'required',
            'price' => 'required',
        ]);
    }

    public function updateProduct()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'price' => 'required',
        ]);

        //product update
        $product =  Product::find($this->edit_id);
        $product->title = $this->title;
        $product->price = $this->price;
        $product->save();

        //product multiple image insert
        if ($this->images!='') {
            foreach ($this->images as $key => $image) {
                $productImage = new ProductImages();
                $productImage->product_id = $product->id;
                $imageName = time() . $key . '.' . $this->images[$key]->extension();
                $this->images[$key]->storeAs('all', $imageName);
                $productImage->image =  $imageName;
                $productImage->save();
            }
        }

        $this->images = '';

        session()->flash('message', 'Product Has Updated Succesfully');
        return redirect()->route('list.products');
    }

    //for single image delete
    public function deleteImage($id, $filename)
    {
        
        //file remove from folder 
        if (File::exists('uploads/all/' . $filename)) {
            File::delete('uploads/all/' . $filename);
        }

        ProductImages::where('id', $id)->delete();

        session()->flash('message', 'Image Deleted Succesfully');
    }


    public function render()
    {
        $productImages = ProductImages::where('product_id', $this->edit_id)->where('status', 1)->get();
        return view('livewire.edit-product-component', compact('productImages'));
    }
}
