{{-- filepath: d:\PPL-AgroMart\resources\views\components\dropdown-link.blade.php --}}
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-green-700 dark:text-green-300 hover:bg-green-100 dark:hover:bg-green-800 focus:outline-none focus:bg-green-100 dark:focus:bg-green-800 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
