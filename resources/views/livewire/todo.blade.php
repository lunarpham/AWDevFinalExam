<div>
    <h1 class="mb-2 mt-8 text-xl font-bold uppercase text-slate-500"><i class="fa-solid fa-tag mr-2"></i>Categories</h1>
    <div x-data="{ open: false }" @click.away="open = false" class="text-gray-500 items-center w-full">
        <button @click="open = ! open" class="px-3 py-2 mt-1 mb-2 w-full bg-white rounded-lg text-slate-400 shadow-md font-bold uppercase hover:bg-slate-700 hover:text-white">
            NEW CATEGORY
            <i class="fa-solid fa-plus"></i>
        </button>

        <div x-show="open">
            <div class="flex justify-center">
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
        
            <form class="flex" method="POST" wire:submit.prevent='addCategory'> <!--input cannot be empty-->
                <x-text-input wire:model='category' class="w-full mr-2" />
                <input type="color" wire:model='color' value="#ff0000" wire:submit.prevent='addCategory'
                    class="rounded-md mr-2 bg-white"
                    style="cursor: pointer; border: 1px solid #ccc; padding: 2px; height: 2.8rem">
                <x-primary-button>
                    Add
                </x-primary-button>
            </form>
        </div>
    </div>
    <div class="flex gap-1 flex-wrap mt-4 items-center">
        <button wire:click='clearFilter' class=" text-white py-1 px-4 mr-2 text-xs font-bold uppercase rounded-xl items-center justify-between bg-slate-500 @if ($selectedCategory == '') outline outline-2 outline-offset-2 outline-stone-800 @endif">
                    <span class='font-medium'>ALL</span>
        </button>
        @forelse ($categories as $category)
            <div class="flex text-white py-1 px-4 text-xs font-bold rounded-xl items-center justify-between
                @if ($selectedCategory == $category->id) outline outline-2 outline-offset-2 outline-stone-800 @endif" style="background-color:{{ $category->color }}">
                @if ($editCategory == $category->id)
                    <x-text-input wire:model='editedCategory' class="mr-2 text-black" />
                @else
                    <button wire:click='filteredByCategoryButton({{$category->id}})' class='font-medium mr-3 uppercase'>{{ $category->category }}</button>
                @endif
                <div>
                    @if ($editCategory == $category->id)
                        <button class="opacity-50 mr-1"
                            wire:click='updateCategoryButton({{ $category->id }})'><i class="fa-solid fa-check"></i></button>
                        <button class="opacity-50" wire:click='cancelCategoryEdit'><i class="fa-solid fa-xmark"></i></button>
                    @else
                        <button class="opacity-50 mr-1" wire:click='editCategoryButton({{ $category->id }})'><i class="fa-solid fa-pen"></i></button>
                        <button class="opacity-50"
                            wire:click='deleteCategoryButton({{ $category->id }})'><i class="fa-solid fa-xmark"></i></button>
                    @endif
                </div>

            </div>

            <div>
            </div>
        @empty
        @endforelse

    </div>
    <x-input-error :messages="$errors->get('editedCategory')" />

    <div class="flex justify-between">
        
    </div>
    <h1 class="mb-2 mt-8 text-xl font-bold uppercase text-slate-500"><i class="fa-solid fa-list mr-2"></i>Todos</h1>

    <div x-data="{ open: false }" @click.away="open = false" class="text-gray-500 items-center w-full">
        <button @click="open = ! open" class="px-3 py-2 mt-1 mb-2 w-full bg-white rounded-lg text-slate-400 shadow-md font-bold uppercase hover:bg-slate-700 hover:text-white">
            NEW TODO
            <i class="fa-solid fa-plus"></i>
        </button>

        <div x-show="open">
            <div class="flex justify-center">
                <x-input-error :messages="$errors->get('todo')" class="mt-2" />
            </div>
        
            <form class="flex" method="POST" wire:submit.prevent='addTodo'> <!--input cannot be empty-->
                <x-text-input wire:model='todo' class="w-full mr-2" />
                <select wire:model='category_id' class="rounded-md mr-2 capitalize">
                    <option value="0">None</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <x-primary-button>
                    Add
                </x-primary-button>
            </form>
        </div>
    </div>

    @forelse($todos as $todo)

        <div class="@if ($todo->is_completed) flex bg-white opacity-25 my-4 p-4 rounded-xl items-center justify-between shadow-md
        @else flex bg-white my-4 p-4 rounded-xl items-center justify-between shadow-md @endif hover:outline outline-2 outline-slate-500">

            <div>
                @if ($edit == $todo->id)
                    <div class="flex">
                        <select wire:model='editedCategory' class="rounded-md mr-2">
                            <option value="">None</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @empty
                            @endforelse
                        </select>
                        <div class="flex-col">
                            <x-text-input wire:model='editedTodo' class="w-full mr-2" />
                            <x-input-error :messages="$errors->get('editedTodo')" />
                        </div>

                    </div>
                @else
                    <div class="flex flex-col">
                        <div class="flex items-center">
                            @if ($todo->category == null)
                                <div></div>
                            @else
                                <div class="flex text-white py-1 px-4 text-xs font-bold uppercase rounded-xl text-center mr-2"
                                    style="background-color:{{ $todo->category->color }}">
                                    {{ $todo->category->category }}</div>
                            @endif
                            <span @if ($todo->is_completed) class='line-through font-medium' @else class='font-medium' @endif
                                class='font-bold'>{{ $todo->todo }}</span>
                        </div>

                        <span class="text-gray-400">Created at {{ $todo->created_at }}</span>
                    </div>
                @endif
            </div>

            <div>

                @if ($edit == $todo->id)
                    <button class="bg-cyan-600 hover:bg-cyan-800 text-white px-3 py-2 rounded-md"
                        wire:click='updateTodo({{ $todo->id }})'><i class="fa-solid fa-check"></i></button>
                    <button class="bg-pink-800 text-white px-3 py-2 rounded-md" wire:click='cancelEdit'><i class="fa-solid fa-xmark"></i></button>
                @else
                    <button
                        @if ($todo->is_completed) class="bg-slate-400 hover:bg-slate-600 text-white px-3 py-2 rounded-md"
                        @else
                        class='bg-teal-500 hover:bg-teal-700 text-white px-3 py-2 rounded-md'
                        @endif
                        wire:click='markCompleted({{ $todo->id}})'>
                        @if ($todo->is_completed)
                            <i class="fa-solid fa-rotate-left"></i>
                        @else
                            <i class="fa-solid fa-check"></i>
                        @endif
                    </button>
                    <button wire:click='editTodo({{ $todo->id }})'
                        class="bg-cyan-600 hover:bg-cyan-800 text-white px-3 py-2 rounded-md"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button wire:click='deleteTodo({{ $todo->id }})'
                        class="bg-pink-800 hover:bg-pink-900 text-white px-3 py-2 rounded-md"><i class="fa-solid fa-trash"></i></button>
                @endif
            </div>


        </div>

    @empty

    @endforelse

</div>
