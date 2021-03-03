@foreach($subcategories as $sub_key => $subcategory)
    <ul style="list-style: none;">
        <li value="{{$sub_key}}">
            <label>
                <input type="checkbox" value="{{$subcategory->id}}" name="categories[]">
                {{$subcategory->title}}
            </label>
            @if(count($subcategory->children))
                @include('blog.backend.articles.sub_category_list',['subcategories' => $subcategory->children])
            @endif
        </li>
    </ul>
@endforeach