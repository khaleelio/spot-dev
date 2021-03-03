@foreach($subcategories as $sub_key => $subcategory)
    <ul style="list-style: none;">
        <li value="{{$sub_key}}">
            <label>
                <input type="checkbox" value="{{$subcategory->id}}" name="categories[]"
                    @if(in_array($subcategory->id,$article->categories))
                        checked
                    @endif
                    >
                {{$subcategory->title}}
            </label>
            @if(count($subcategory->children))
                @include('blog.backend.articles.sub_category_edit',['subcategories' => $subcategory->children])
            @endif
        </li>
    </ul>
@endforeach