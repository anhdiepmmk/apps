<div class="nborder">
   <div class="breadcrumbs">
       <h4 class="pull-left">
           @if($parentCategory->id == 1)
               <i class="fa fa-android"></i>
           @else
               <i class="fa fa fa-gamepad"></i>
           @endif

        {{ $parentCategory->name }} Category
       </h4>
   </div>
   @foreach($categories as $category)
          <?php
              $link = url($parentCategory->slug.'/'.$category->slug);
          ?>
          <div class="col-xs-4 col-sm-12 topNew">
              <div class="thumbnail">
                  <div class="picCard">
                      <a href="{{ url($link) }}" title="{{ $category->name }}">
                          <img src="{{ $category->getCatImage() }}" alt="{{ $category->name }}">
                      </a>
                  </div>
                  <div class="caption">
                      <h3  style="font-weight: normal!important;" class="titleCard te"><a href="{{ $link }}" title="{{ $category->name }}">{{ $category->name }}</a></h3>
                      <!--
                      <p class="subCard te"><a href="">xxx</a></p>
                      -->
                  </div>
              </div>
          </div>
      @endforeach
   <div class="clearfix"></div>
</div>