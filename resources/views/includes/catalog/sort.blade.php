<x-form route="catalog" method="GET" class="py-1">
    <div class="row">
        <div class="col-md-3">
            <x-select name="sort_type">
                <option @if ($sort_type == 'default') selected @endif value="default">
                    Сортировать</option>
                <option @if ($sort_type == 'cost') selected @endif value="cost">По цене
                </option>
                <option @if ($sort_type == 'name') selected @endif value="name">По
                    наименованию</option>
            </x-select>
        </div>

        <div class="col-md-3">
            <x-select name="order">
                <option @if ($order == 'desc') selected @endif value="desc">По убыванию
                </option>
                <option @if ($order == 'asc') selected @endif value="asc">По
                    возрастанию</option>
            </x-select>
        </div>

        <div class="col-md-3">
            <x-select name="category_id">
                <option @if ($category_id == 0) selected @endif value="0">Выбрать
                    категорию</option>
                @foreach ($categories as $category)
                    <option @if ($category_id == $category->id) selected @endif
                        value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="col-md-3">
            <x-submit class="btn-success w-100">Применить</x-submit>
        </div>
    </div>
</x-form>