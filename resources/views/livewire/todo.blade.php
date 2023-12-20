<div>
    <script src="https://kit.fontawesome.com/e2653b8883.js" crossorigin="anonymous"></script>
    <div class="flex justify-center">
    <x-input-error :messages="$errors->get('todo')" class="mt-2" />
    </div>
 
    <form class="flex" method="POST" wire:submit.prevent='addTodo'> <!--input cannot be empty-->
    <x-text-input wire:model='todo' class="w-full mr-2"/>
    <x-primary-button >
        Add
    </x-primary-button>
    </form>    
 
    @forelse($todos as $todo)

    <div
        @if($todo->is_completed)
        class="flex bg-white opacity-50 my-4 p-4 rounded-xl items-center justify-between shadow-md"
        @else
        class="flex bg-white my-4 p-4 rounded-xl items-center justify-between shadow-md"
        @endif
        
    >

        <div>
            @if ($edit == $todo->id)
            <x-text-input wire:model='editedTodo' class="w-full mr-2"/>

            @else
            <div class="flex flex-col">
                <span @if($todo->is_completed) class='line-through font-medium' @endif class='font-bold'>{{ $todo->todo }}</span>
                <span class="text-gray-400">Created at {{ $todo->created_at }}</span>
            </div>
            

            @endif
        </div>
     
        <div>

            @if ($edit == $todo->id)
            <button class="bg-indigo-500 text-white px-4 py-2 rounded-md" wire:click='updateTodo({{ $todo->id }})'>Update</button>
            <button class="bg-red-800 text-white px-4 py-2 rounded-md" wire:click='cancelEdit'>Cancel</button>
            
            @else
            <button @if($todo->is_completed) class="bg-slate-400 text-white px-4 py-2 rounded-md" @endif class='bg-green-700 text-white px-4 py-2 rounded-md' wire:click='markCompleted({{ $todo->id }})'>Check</button>
            <button wire:click='editTodo({{ $todo->id }})' class="bg-indigo-500 text-white px-4 py-2 rounded-md">Edit</button>
            <button wire:click='deleteTodo({{ $todo->id }})' class="bg-red-800 text-white px-4 py-2 rounded-md">Delete</button>
            @endif
        </div>
        
        
    </div>
    @empty
        
    @endforelse
 
</div>