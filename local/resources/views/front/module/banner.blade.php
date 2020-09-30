<section class="bg-default-img img-responsive">
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-auto">
                <div class="mt-4 pt-3 mb-4 pb-3">
                    <div class="text-center">
                        <form id="search-form" class="careerfy-banner-search" method="get" action="{{url('/search')}}">
                            <ul>
                                <li>
                                    <input  type="text" name="title">
                                </li>
                                <li>
                                    <div class="careerfy-select-style">
                                        <select name="location">
                                            <option value="">Select Location</option>
                                            @foreach($data['location'] as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="careerfy-select-style">
                                        <select name="category">
                                            <option value="">Select Category</option>
                                            @foreach($data['category'] as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li class="careerfy-banner-submit"> <input type="submit"  value=""> <i id="search-button" class="careerfy-icon careerfy-search"></i> </li>
                            </ul>
                        </form>
                        <!-- banner search form section ended here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function () {
        $('#search-button').click(function(){
            $('#search-form').submit();
        });
    });
</script>