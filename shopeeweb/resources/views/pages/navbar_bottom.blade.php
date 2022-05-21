<div class="header-bottom">
    <!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{URL::to('/tim-kiem')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="search_box pull-right">
                        <input type="text" style="color:#666;" name="keywords_submit" placeholder="Tìm kiếm" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/header-bottom-->
</header>