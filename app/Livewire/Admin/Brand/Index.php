<?php

namespace App\Livewire\Admin\Brand;
use Livewire\Component;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $name,$slug,$status,$updateMode = false,$brand_id,$category_id;


    public function rules()
    {
        return [
            'name'=>'required|string',
            'slug'=>'required|string',
            'category_id'=>'required|integer',
            'status'=>'nullable'
        ];
    }
    private function resetForm()
{
    $this->reset([

        'name',
        'slug',
        'status',
        'category_id',
    ]);
}
    public function storeBrand()
    {
        $validatedData=$this->validate();
        Brand::create(
            [
                'name'=>$this->name,
                'slug'=>Str::slug($this->slug),
                'status'=>$this->status==true ? '1':'0',
                'category_id'=>$this->category_id,
            ]
            );
            session()->flash('message','Brand Added Succesfully');
           // $this->dispatchBrowserEvent('close-modal');
             $this->dispatch('close-modal');
             $this->resetForm();
            //$this->resetInput();

      }
      public function editBrand(int $brand_id)
        {
          $this->brand_id=$brand_id;
        $brand=Brand::findOrFail($brand_id);
        $this->name=$brand->name;
        $this->slug=$brand->slug;
        $this->status=$brand->status;
        $this->category_id=$brand->category_id;
        $this->updateMode = true;
        }
      public function updateBrand()
      {
          $validatedData=$this->validate();
          Brand::findOrFail($this->brand_id)->update(
              [
                  'name'=>$this->name,
                  'slug'=>Str::slug($this->slug),
                  'status'=>$this->status==true ? '1':'0',
                  'category_id'=>$this->category_id,
              ]
              );
              session()->flash('message','Brand updated Succesfully');
             // $this->dispatchBrowserEvent('close-modal');
               $this->dispatch('close-modal');
               $this->resetForm();
             // $this->resetInput();

        }


    public function render()
    {   $categories=Category::where('status','0')->get();
        $brands=Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index',['brands'=>$brands,'categories'=>$categories])
                    ->extends('layouts.admin')
                    ->section('content');
    }

    public function openModal()
    {
       // $this->resetInput();
       $this->resetForm();
    }
    public function closeModal()
    {
        $this->resetForm();
        //$this->resetInput();
        $this->updateMode = false;
    }
    public function deleteBrand($brand_id)
    {
        $this->brand_id=$brand_id;
    }
    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Deleted Succesfully');
             // $this->dispatchBrowserEvent('close-modal');
               $this->dispatch('close-modal');
               $this->resetForm();
              //$this->resetInput();
    }

}
