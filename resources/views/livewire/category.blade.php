<div>
    <h1 class="mb-3 text-xl font-bold">Categories</h1>
    <div class="flex justify-center">
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
 
    <form class="flex" method="POST" wire:submit.prevent='addCategory'> <!--input cannot be empty-->
        <x-text-input wire:model='category' class="w-full mr-2"/>
        <input type="color" wire:model='color' value="#ff0000" wire:submit.prevent='addCategory' class="rounded-md mr-2 bg-white" style="cursor: pointer; border: 1px solid #ccc; padding: 2px; height: 2.8rem">
        <x-primary-button>
            Add
        </x-primary-button>
    </form>
    <div class="flex gap-1 flex-wrap">
        @forelse($categories as $category)

        <div class="flex my-4 text-white py-1 px-4 text-xs font-bold uppercase rounded-sm items-center justify-between" style="background-color:{{$category->color}}">
            @if($editCategory == $category->id)
            <x-text-input wire:model='editedCategory' class="mr-2 text-black"/>
            @else
            <span class='font-medium mr-3'>{{ $category->category }}</span>
            @endif
            <div>
                @if($editCategory == $category->id)
                <button class="opacity-50" wire:click='updateCategoryButton({{$category->id}})'>Update</button>
                <button class="opacity-50" wire:click='cancelCategoryEdit'>Cancel</button>

                @else
                <button class="opacity-50" wire:click='editCategoryButton({{$category->id}})'>Edit</button>
                <button class="opacity-50" wire:click='deleteCategoryButton({{$category->id}})'>Delete</button>
                @endif
            </div>
            
        </div>
        
        <div>
        </div>

        @empty
            
        @endforelse
    </div>
    <x-input-error :messages="$errors->get('editedCategory')"/>

</div>
