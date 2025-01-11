@props(['disabled' => false, 'accept' => '*'])

<input type="file" accept="{{ $accept }}" @disabled($disabled)
        {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm file:border-0 file:bg-blue-600 file:text-white file:px-4 file:py-2 file:rounded-md file:cursor-pointer hover:file:bg-blue-700']) }}>
