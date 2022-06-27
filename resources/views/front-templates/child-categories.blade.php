<li><a href="{{ route('front.category.show', $child_category->slug) }}">{{ $child_category->name }}</a></li>
  @if($child_category->categories)
    <ul>
      @foreach ($child_category->categories as $childCategory)
        @include('front-templates.child-categories', ['child_category' => $childCategory])
      @endforeach
    </ul>
  @endif