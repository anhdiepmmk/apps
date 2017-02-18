<div class="nborder">
   <div class="breadcrumbs">
       <h4 class="pull-left">Top Games</h4>
   </div>
   @foreach($topgames as $app)
       <?php
            $link = url('android-apps-games/'.$app->category->slug.'/'.$app->slug);
       ?>
       <div class="col-xs-4 col-sm-12 topNew first">
           <div class="thumbnail">
               <div class="picCard">
                   <a href="{{ url($link) }}" title="{{ $app->name }}">
                       <img src="{{ asset('storage/'.$app->path.'/170/'.$app->image) }}" alt="{{ $app->name }}">
                   </a>
               </div>
               <div class="caption">
                   <h3 class="titleCard te"><a href="{{ $link }}" title="{{ $app->name }}">{{ $app->name }}</a></h3>
                   <p class="subCard te"><a href="{{ url('manufacture/'.$app->developer->slug) }}">{{ $app->developer->name }}</a></p>
               </div>
           </div>
       </div>
   @endforeach
   <div class="clearfix"></div>
</div>