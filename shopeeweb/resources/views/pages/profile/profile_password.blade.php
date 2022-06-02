@extends('pages.profile')
@section('profile_content')

<!-- Đổi mật khẩu -->
<?php

use Illuminate\Support\Facades\Session;

?>

<div class="xMDeox">
    <div class="Hvae38" role="main">
        <form action="" id="form-change-password">
            {{ csrf_field() }}
            <div class="DQHtXe">
                <div class="FUOi1p">
                    <h1 class="DSKSYU">Đổi mật khẩu</h1>
                    <div class="tk-R8Z">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</div>
                </div>
                <div class="fo5IeT">
                    <div class="Kuz0mN">
                        <div class="A8yLgM">
                            <div class="ltFKuQ">
                                <div class="op-21F"><label class="mlaS58" for="password">Mật khẩu hiện tại</label></div>
                                <div class="iqUYOb">
                                    <input id="password" class="-wQUjw kpK-3W" type="password" autocomplete="off" name="password" value="" placeholder="Nhập mật khẩu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Kuz0mN">
                        <div class="A8yLgM">
                            <div class="ltFKuQ">
                                <div class="op-21F"><label class="mlaS58" for="newPassword">Mật khẩu mới</label></div>
                                <div class="iqUYOb"><input id="newPassword" class="-wQUjw kpK-3W" type="password" autocomplete="off" name="newPassword" value="" placeholder="Nhập mật khẩu mới"></div>
                            </div>
                        </div>
                    </div>
                    <div class="Kuz0mN">
                        <div class="A8yLgM">
                            <div class="ltFKuQ">
                                <div class="op-21F"><label class="mlaS58" for="newPasswordRepeat">Xác nhận mật khẩu</label></div>
                                <div class="iqUYOb"><input id="newPasswordRepeat" class="-wQUjw kpK-3W" type="password" autocomplete="off" name="newPasswordRepeat" value="" placeholder="Xác nhận mật khẩu"></div>
                            </div>
                        </div>
                    </div>
                    <span class="_7vstgM forget_password">Quên mật khẩu?</span>
                    <div class="Kuz0mN">
                        <div class="RlzsL7"></div>
                        <div class="vuqET4">
                            <button type="submit" id="btn_change_pass" class="btn btn-change-password">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form-change-password').submit(function(e) {
            e.preventDefault();
            $('#btn_change_pass').html('Đang xử lý...').prop('disabled', true);
            let password = $('#password').val();
            let newPassword = $('#newPassword').val();
            let newPasswordRepeat = $('#newPasswordRepeat').val();
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{URL::to("form-change-password-post")}}',
                type: 'post',
                data: {
                    '_token': token,
                    'password': password,
                    'newPassword': newPassword,
                    'newPasswordRepeat': newPasswordRepeat,
                },
                success: function(res) {
                    if (res.status === 403) {
                        swal('Thông báo', res.msg, 'error');
                    }
                    if (res.status === 200) {
                        swal('Thông báo', res.msg, 'success');
                        setTimeout(function() {
                            window.location.href = 'user-logout';
                        }, 1000);
                    }
                    $('#btn_change_pass').html('Xác nhận').prop('disabled', false);
                }
            });
        });

        $('.forget_password').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Nhập email tài khoản',
                input: 'email',
                inputPlaceholder: 'Email',
            }).then((result) => {
                if (result.isConfirmed) {
                    loadingFlight('show', 'Loading')
                    $.ajax({
                        url: '/forget-password\/' + result.value,
                        type: 'get',
                        success: function(res) {
                            if (res.status === 403) {
                                swal('Thông báo', res.msg, 'error');
                            }
                            if (res.status === 200) {
                                swal('Thông báo', res.msg, 'success');
                            }
                            loadingFlight('hide', 'Loading')
                        }
                    });
                }
            })

        });
    });
</script>
@endsection