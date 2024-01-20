<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category,$product,$prodColorSelectedQuantity;
    public function addToWishList($productId)
    {
        if(Auth::check())
        {

            if(wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
            {
                session()->flash('error','Product already added to wishlist');
                $this->dispatch('message',[
                    'text'=>'Product already added to wishlist',
                    'type'=>'warning',
                    'status'=>409
                ]);
                return false;
            }
            else
            {
                Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productId
                ]);
                session()->flash('message','Product added to wishlist');
                $this->dispatch('message',[
                    'text'=>'Product added to wishlist',
                    'type'=>'success',
                    'status'=>200
                ]);
            }


        }
        else
        {
            session()->flash('message','Please login to add product to wishlist');
            $this->dispatch('message',[
                'text'=>'Please login to continue',
                'type'=>'info',
                'status'=>401
            ]);
            return false;
        }
    }
    public function colorSelected($productColorId)
    {
        // dd($productColorId);
        $productColor=$this->product->productColors()->where('id',$productColorId)->first();
         $this->prodColorSelectedQuantity=$productColor->quantity;
         if($this->prodColorSelectedQuantity==0)
         {
            $this->prodColorSelectedQuantity='Out of Stock';
         }

    }
    public function mount($category,$product)
    {
        $this->category=$category;
        $this->product=$product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=>$this->category, //passing category and product to view.blade.php
            'product'=>$this->product
        ]);
    }
}
