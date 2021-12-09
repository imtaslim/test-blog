<div class="mb-4">
    <label class="block" for="task">Name</label>
    <input class="focus" type="text" name="name" id="name" value="{{ old('name', isset($posts) ? $posts->name : '') }}">
    <p class="text-red-600">{{ $errors->first('name') }}</p>
</div>
<div class="mb-4">
    <label class="block" for="task">Category Name</label>
    <select name="category_id" id="category_id" multiple="true">
        <option value="">Select Category</option>
        @foreach ($categories as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    <p class="text-red-600">{{ $errors->first('category_id') }}</p>
</div>
<div class="mb-4">
    <label class="block" for="image">Image</label>
    <input type="file" name="image" id="image">
</div>
<button class="px-4 py-2 bg-green-600" type="submit">{{ $buttonText }}</button>
