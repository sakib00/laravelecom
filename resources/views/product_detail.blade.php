@extends('layouts.app')

@section('content')
  
    <div class="row" style="margin: 30px 0px">
     
      <div class="col-md-6">

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ $data->product_name }}</h4>
          </div>
          <div class="card-body"  style="text-align: center;">
            <span class='zoom' id='ex1'>
              <img class="zoom-img" src="{{asset('images/product_image/'.$data->product_image)}}"  width='600' height='320' alt="SHOW IMAGE HERE" style="max-width:325px">
            </span>
          </div>
          <div class="card-footer">
            <small class="text-muted"><strong>Price: {{ $data->product_price }}</strong></small>
          </div>
        </div>
      </div>    
     
      <div class="col-md-6">
        <div class="product-variation">
            <form id="submitCart" action="{{url('/')}}/add-to-cart" method="post">
               {{ csrf_field() }}
                <input type="hidden" name="product_row_id" value="{{ $data->product_row_id }}"/>
              <div class="cart-plus-minus">
                <label for="qty">Quantity:</label>
                <div class="numbers-row">
                  <input type="number" class="qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                </div>
              </div>
                <button class="pro-add-to-cart btn btn-primary" title="Add to Cart" type="submit" style=" margin-top: 20px;">
                  <span><i class="fa fa-shopping-cart"></i> Add to Cart</span>
               </button>
            </form>
          </div>
      </div>
    </div>

    <div class="row">
    <div class="col-md-8">
        <div class="tabs">
          <div class="tab-button-outer">
            <ul id="tab-button">
              <li><a href="#tab01">Description</a></li>
              <li><a href="#tab02">Rating/Reviews</a></li>
            </ul>
          </div>
          <div class="tab-select-outer">
            <select id="tab-select">
              <option value="#tab01">Description</option>
              <option value="#tab02">Rating/Reviews</option>
            </select>
          </div>

          <div id="tab01" class="tab-contents">
            <h2>Description</h2>
            <p>{{ $data->product_description }}</p>
          </div>
          <div id="tab02" class="tab-contents">
            <h2>Ratings & Reviews</h2>
            <div id="reviews" class="woocommerce-Reviews">
              <div id="comments">
                @if(!$product_ratings->isEmpty())
                  @foreach($product_ratings as $rating)
                  <div id="comment_rating_{{ $rating->id }}" class="row" style="border: 2px solid #337ab7; border-radius: 5px; margin: 10px 0px; padding: 10px;">
                      <div class="col-md-2 col-sm-2 hidden-xs">
                        <figure class="thumbnail">
                          <img class="img-responsive" src="{{ asset('images/sample_user.png') }}">
                          <figcaption class="text-center"></figcaption>
                        </figure>
                      </div>
                      <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow left">
                          <div class="panel-body">
                            <header class="text-left">
                              <div class="comment-user"><i class="fa fa-user"></i> {{ $rating->name }}</div>
                              <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {{ date('Y/m/d', strtotime($rating->created_at))}}</time>
                            </header>
                            <div class="comment-post">
                              <p>
                                {{ $rating->reviews }}
                              </p>
                            </div>
                            <!-- <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                @else
                <p class="woocommerce-noreviews">There are no reviews yet.</p>
                @endif
              </div>
              <a class="btn btn-primary" data-toggle="collapse" href="#review_form_wrapper" role="button" aria-expanded="false" aria-controls="collapseExample">
                Give your review here
              </a>
              <div class="collapse" id="review_form_wrapper">
                <div id="review_form">
                  <div id="respond" class="comment-respond woocommerce">     
                    <form action="{{ url('/') }}/product/submitRating" method="post" id="commentform" class="comment-form" novalidate="">
                      {{ csrf_field() }}
                      <p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p>
                      <div class="comment-form-rating">
                        <label for="rating">Your rating</label>
                        <fieldset class="rating">
                          <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                          <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                          <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                          <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Average - 3.5 stars"></label>
                          <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Average - 3 stars"></label>
                          <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Satisfactory - 2.5 stars"></label>
                          <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Satisfactory - 2 stars"></label>
                          <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Poor - 1.5 stars"></label>
                          <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Poor - 1 star"></label>
                          <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Too Poor- 0.5 stars"></label>
                        </fieldset>
                      </div>
                      <div style="clear: both;">
                        <p class="comment-form-comment">
                          <label for="comment">Your review &nbsp;<span class="required">*</span></label>
                          <textarea id="comment" name="comment" cols="45" rows="8" required /></textarea>
                        </p>
                        <p class="comment-form-name">
                          <label for="name">Name &nbsp;<span class="required">*</span></label> 
                          <input id="name" name="name" type="text" value="" size="30" required /></p>
                          <p class="comment-form-email">
                          <label for="email">Email &nbsp;<span class="required">*</span></label>
                          <input id="email" name="email" type="email" value="" size="30" required /></p>
                          <p class="form-submit">
                            <input name="submit" type="button" id="submitreview" class="btn btn-primary" value="Submit"> 
                            <input type="hidden" name="product_id" value="{{ $data->product_row_id }}" id="product_id">
                            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                          </p>
                      </div>
                      </form>
                  </div><!-- #respond -->
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#ex1').zoom();
      $(function() {
        var $tabButtonItem = $('#tab-button li'),
            $tabSelect = $('#tab-select'),
            $tabContents = $('.tab-contents'),
            activeClass = 'is-active';

        $tabButtonItem.first().addClass(activeClass);
        $tabContents.not(':first').hide();

        $tabButtonItem.find('a').on('click', function(e) {
          var target = $(this).attr('href');

          $tabButtonItem.removeClass(activeClass);
          $(this).parent().addClass(activeClass);
          $tabSelect.val(target);
          $tabContents.hide();
          $(target).show();
          e.preventDefault();
        });

      });

      $( "#submitreview" ).on( "click", function( event ){

        $.ajax({
          type: 'POST',
          url: "{{ url('product/submitRating') }}",
          data: $('#commentform').serialize(),
          success: function(data){
            $("#comments").append(data);
            $('html, body').animate({
              scrollTop: $("#comments").offset().top
            },1000)
            $("#comment").val('');
            $("#name").val(' ');
            $("#email").val(' ');
          }
        });

      });

    });
  </script>
@endsection
