<div class="bg-gray-100 px-4 my-4 pb-1 rounded  w-1/2 shadow">
  <div class="flex justify-evenly gap-4">

    <div class="mt-2 w-full">
      <select name="year" class="form-control" wire:model.defer="year">
        <option value=''>Select Search</option>
        <option value="3">Dispatch Number</option>
        <option value="4">Reference Letter Number </option>
        <option value="5">Subject</option>
      </select>
    </div>

    <div class="mt-2 w-full">
      <input type="text" name="textsearch" class="form-control" wire:model.defer="textsearch">
    </div>

     <div class="flex gap-2 mt-2 w-full md:w-6/12">   
        <!-- Search -->
      <a href="#" class="bg-sky-600 px-6 py-2 rounded-full text-white uppercase text-sm font-bold hover:bg-sky-500">
        <i class="fa fa-search mr-2"></i> Search
      </a>

    </div>
  </div>
</div>