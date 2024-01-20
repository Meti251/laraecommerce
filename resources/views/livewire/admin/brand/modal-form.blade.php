
<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brands</h1>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form wire:submit.prevent="storeBrand">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Select Category</label>
                <select wire:model.defer="category_id" required class="form-control">
                    <option value="">--Select Category--</option>
                    @foreach ($categories as $cateItem)
                    <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                    @endforeach

                </select>
                @error('category_id')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="">Brand Status</label>
                    <input type="checkbox" wire:model.defer="status"/>checked=hidden,unchecked=visible
                </div> --}}
                <div class="mb-3">
                    <label for="">Brand Status</label>
                    <input type="checkbox" wire:model.defer="status"/>
                </div>

                @error('status')
                        <small class="text-danger">{{$message}}</small>
                 @enderror

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>

      </div>
    </div>
  </div>


  {{-- brand update modal --}}

<div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brands</h1>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
        </div>
        <div wire:loading.remove>
        <form wire:submit.prevent="updateBrand()">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Select Category</label>
                <select wire:model.defer="category_id" required class="form-control">
                    <option value="">--Select Category--</option>
                    @foreach ($categories as $cateItem)
                    <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                    @endforeach

                </select>
                @error('category_id')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Brand Status</label>
                    <input type="checkbox" wire:model.defer="status" width="70px" height="70px;"/>checked=hidden,unchecked=visible
                </div>
                @error('status')
                        <small class="text-danger">{{$message}}</small>
                 @enderror

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
        </form>
    </div>
      </div>
    </div>
  </div>

  <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Brands</h1>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading>
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
        </div>
        <div wire:loading.remove>
        <form wire:submit.prevent="destroyBrand()">
            <div class="modal-body">
                <div>
                    <h4>Are you sure you want to Delete this Brand?</h4>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Yes.Delete</button>
              </div>
        </form>
    </div>
      </div>
    </div>
  </div>
