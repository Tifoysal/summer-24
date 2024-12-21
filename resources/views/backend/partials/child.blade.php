
                
               <ol>
                @foreach($parent->child as $child)
                  @if(count($child->child) > 0)
                  
                    <li>
                       <span class="num"></span>
                       <a href="#">{{$child->name}}</a>
                    </li>
                    @include('backend.partials.child',['parent'=>$child])
                  @else

                    <li>
                       <span class="num"></span>
                       <a href="#">{{$child->name}}</a>
                    </li>
                    @endif
                    @endforeach
                    </ol>
                