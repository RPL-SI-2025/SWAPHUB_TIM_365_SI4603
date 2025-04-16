@extends('layouts.app')
@section('content')
  <style>
    .image-hover-container {
      position: relative;
      overflow: hidden;
      border-radius: 0.5rem;
    }

    .image-hover-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      /* semi-transparent dark overlay */
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 0.5rem;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    .image-hover-container:hover .image-hover-overlay {
      opacity: 1;
    }

    .image-hover-title {
      font-size: 1rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 0.5rem;
    }

    .button-container {
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      top: 0.5rem;
      right: 0.5rem;
      position: absolute;
    }

    .action-btn {
      color: white;
      border: none;
      border-radius: 0.25rem;
      padding: 0.25rem 0.5rem;
      font-size: 0.75rem;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }
  </style>


  <form class="mx-auto mb-6">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
      </div>
      <input type="search" id="default-search"
        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Search Wishlist..." required />
      <button type="submit"
        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
  </form>

  <h1 class="text-3xl font-bold mb-6">Wishlist</h1>

  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="image-hover-container">
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg"
        alt="Nama Barang 1">
      <div class="image-hover-overlay">
        <div class="image-hover-title">Nama Barang 1</div>
        <div class="button-container">
          <button class="action-btn bg-yellow-500 hover:bg-yellow-600">Tukar</button>
          <button class="action-btn bg-red-500 hover:bg-red-600">Hapus</button>
        </div>
      </div>
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-6.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-7.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-8.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-9.jpg"
        alt="">
    </div>
    <div>
      <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-10.jpg"
        alt="">
    </div>
    <div>
      <div
        class="h-full max-w-full rounded-lg bg-gray-200 flex items-center justify-center text-gray-500 cursor-pointer hover:bg-gray-300 transition duration-200 ease-in-out">
        + New Collection
      </div>
    </div>
  </div>
@endsection
