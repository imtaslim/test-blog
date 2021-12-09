<div class="mb-4">
    <label class="block" for="name">Category Name</label>
    <input class="focus" type="text" name="name" id="name" value="{{ old('name') }}">
    <p class="text-red-600">{{ $errors->first('name') }}</p>
</div>
<button class="px-4 py-2 bg-green-600" type="submit">{{ $buttonText }}</button>
