{{--   @foreach($categories as $category)--}}
{{--       <li> <a href="#" title="" class="des-font link-default link-collection">{{$category['category']['title']}}</a></li>--}}
{{--   @endforeach--}}
@foreach($categories as $category)
       <li> <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.blogCat',$category->id)}} @else  {{route('frontend.blogs.blogCat',$category->id)}} @endif" title="" class="des-font link-default link-collection">{{$category->title}}</a></li>
   @endforeach
