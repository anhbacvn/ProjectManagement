@extends('pages.profile')
@section('profile_content')
<!-- Hồ sơ của tôi -->
<div class="content__info">
    <div class="content__info-header-profile">
        <h3 style="margin-top:0;margin-bottom:5px;margin-top:6px;">Hồ sơ của tôi</h3>
        <div>Quản lý thông tin hồ sơ để bảo mật tài khoản</div>
    </div>
    <form id="form-change-info" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="content__info-form">
            <div class="col-sm-8">
                <div class="input-group">
                    <h5>Tên đăng nhập</h5>
                    <input type="text" value="{{$get_info_user->user_login}}" name="user_login">
                </div>
                <div class="input-group">
                    <h5>Tên</h5>
                    <input type="text" value="{{$get_info_user->name}}" name="user_name">
                </div>
                <div class="input-group">
                    <h5>Email</h5>
                    <input type="text" value="{{$get_info_user->email}}" name="user_email">
                </div>
                <div class="input-group">
                    <h5>Số điện thoại</h5>
                    <input type="text" value="{{$get_info_user->phone}}" name="user_phone">
                </div>
                <div class="input-group">
                    <h5>Giới tính</h5>
                    <div class="radio-group">
                        @if($get_info_user->gender == 'Nam')
                        <label style="color:rgba(0,0,0,.75);"><input class="user-gender" value="Nam" type="radio" name="gender" checked>Nam</label>
                        <label style="color:rgba(0,0,0,.75);"><input class="user-gender" value="Nữ" type="radio" name="gender">Nữ</label>
                        @elseif($get_info_user->gender == 'Nữ')
                        <label style="color:rgba(0,0,0,.75);"><input class="user-gender" value="Nam" type="radio" name="gender">Nam</label>
                        <label style="color:rgba(0,0,0,.75);"><input class="user-gender" value="Nữ" type="radio" name="gender" checked>Nữ</label>
                        @else
                        <label style="color:rgba(0,0,0,.75);"><input class="user-gender" value="Nam" type="radio" name="gender">Nam</label>
                        <label style="color:rgba(0,0,0,.75);"><input class="user-gender" value="Nữ" type="radio" name="gender">Nữ</label>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <h5>Ngày sinh</h5>
                    <input type="date" style="cursor:pointer;" value="{{$get_info_user->birthday}}" name="user_birthday">
                </div>
                <button type="submit" class="btn-change-profile">Cập nhật</button>
            </div>
            <div class="col-sm-4">
                <div class="content__info-avatar">
                    @if($get_info_user->avatar!=null)
                    <img src="{{URL::to('public/upload/image_user/'.$get_info_user->avatar)}}" alt="" style="width:100px;height:100px;margin:20px 0;">

                    @else
                    <img src="{{URL::to('public/upload/image_user/avatar_default.jpg')}}" alt="" style="width:100px;height:100px;margin:20px 0;">

                    @endif
                    <input id="input-file" name="user_image" type="file" class="btn-change-avatar" style="display:none;"></input>
                    <button id="btn-file" type="button" class="btn-change-avatar">Chọn ảnh</button>
                    <div>
                        <h5 style="color:#999;font-size:1.2rem;line-height:1.25rem;">Dung lượng tối đa 1MB</h5>
                        <h5 style="color:#999;font-size:1.2rem;line-height:1.25rem;">Định dạng:.JPEG, .PNG</h5>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Profile
    $('#form-change-info').submit(function(e) {
        e.preventDefault();
        var formdata = this;

        $.ajax({
            url: '{{URL::to("change-info-post")}}',
            type: 'post',
            data: new FormData(formdata),
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function(res) {
                if (res.status === 403) {
                    swal('Thông báo', res.msg, 'error');
                }
                if (res.status === 200) {
                    var get_email = $('input[name="user_email"]').val();
                    $('input[name="user_email"]').val(protect_email(get_email));
                    swal('Thông báo', res.msg, 'success');
                }
            }
        });
    });

    // Button chọn ảnh
    $('#btn-file').click(function() {
        $('#input-file').click();
    });


    var get_email = $('input[name="user_email"]').val();
    $('input[name="user_email"]').val(protect_email(get_email));
    // Dấu email user
    function protect_email(user_email) {
        var avg, splitted, part1, part2;
        splitted = user_email.split("@");
        part1 = splitted[0];
        avg = part1.length / 2;
        part1 = part1.substring(0, (part1.length - avg));
        part2 = splitted[1];
        return part1 + "***@" + part2;
    };

    $(document).ready(function() {
        $('.my_info--active').removeClass('my_info--active');
        $('#my_info').addClass('my_info--active');
    })
</script>
@endsection