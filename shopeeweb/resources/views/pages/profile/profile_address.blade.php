@extends('pages.profile')
@section('profile_content')
<!-- Địa chỉ -->
<?php

use Illuminate\Support\Facades\Session;

$get_address_user = Session::get('get_address_user');
?>
<div class="content__info">
    <div class="content__info-header-address">
        <h3 style="margin-top:21px;margin-bottom:9px;font-size:1,125em!important;">Địa chỉ của tôi</h3>
        <div class="btn-with-icon" id="add-new-address" style="cursor:pointer">
            <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0" class="shopee-svg-icon icon-plus-sign" style="fill: currentColor;width:12px;height:12px;margin-top:13px;margin-left:10px;text-align:center;color:white;">
                <polygon points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5"></polygon>
            </svg>
            <input type="button" class="btn-change-address" value="Thêm địa chỉ mới" style="color:white;">
        </div>
    </div>
    @if($get_address_user != null)
    <div class="content__info_user">
        @foreach($get_address_user as $item)
        <div class="col-sm-12" style="border-bottom: 1px solid #ccc;padding: 30px 4px 30px 20px;">
            <div class="col-sm-8">
                <div style="display:flex;">
                    <div style="width: 160px;text-align: right;margin-right: 25px;margin-top:22px;font-size:14px;">Họ và tên</div>
                    <div class="info_user_name">
                        <div style="display:flex;margin-top:20px;"><span style="margin-right: 15px;margin-top: 2px;max-width: 350px;font-weight: 500;font-size: 16px;line-height: 1.7rem;;">{{$item->address_shipping_name}}</span>
                            @if($item->address_shipping_status == 1)
                            <div class="a3H75E">
                                <div class="btn-address-default">Mặc định</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div style="display:flex;">
                    <div style="width: 160px;text-align:right;margin-right: 25px;font-size:14px;margin-top:15px;">Số điện thoại</div>
                    <div style="margin-top:14px;">(+84) {{$item->address_shipping_phone}}</div>
                </div>
                <div style="display:flex;">
                    <div style="width: 165px;text-align: right;margin-right: 25px;font-size:14px;margin-top:12px;">Địa chỉ</div>
                    <div style="margin-top:12px;"><span style="margin-top:12px;text-transform:uppercase;">{{$item->address_shipping_detail}}<br>{{$item->address_shipping_city}}, {{$item->address_shipping_district}}, {{$item->address_shipping_wards}}</span></div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="content__address-change">
                    <button id="" type="button" class="content__address-btn edit-address" data-id="{{$item->address_shipping_id}}">Sửa</button>
                    @if(count($get_address_user) > 1 && $item->address_shipping_status == 1)
                    <button type="button" class="content__address-btn" style="margin-left:20px;display:none;">Xóa</button>
                    @else
                    <button type="button" class="content__address-btn profile_address_delete" style="margin-left:20px;" data-id="{{$item->address_shipping_id}}">Xóa</button>
                    @endif
                </div>
                @if($item->address_shipping_status == 1)
                <div class="content__address-change">
                    <button type="button" class="content__address-change-btn btn-light--disabled">Thiết lập mặc định</button>
                </div>
                @else
                <div class="content__address-change">
                    <button type="button" class="content__address-change-btn change_default_address" data-id="{{$item->address_shipping_id}}">Thiết lập mặc định</button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div>
        <div class="content">
            <div style="color: #555;font-size: 18px;padding: 90px 0;text-align: center;width: 100%;">Bạn chưa có địa chỉ</div>
        </div>
    </div>
    @endif
</div>


<!-- The Modal Thêm-->
<div id="myModal" class="modal" style="display: none;">
    <div class="overlay"></div>
    <div class="modal-content">
        <form id="form-add-address" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2 style="align-items: center;display: flex;font-size: 20px;">Địa chỉ mới</h2>
            <div style="display:flex;width:100%;">
                <div class="form-group">
                    <input class="form-input" type="text" id="user_name" name="user_name" placeholder="Họ và tên" style="width: 110%;">
                </div>
                <div style="width: 16px;"></div>
                <div class="form-group">
                    <input class="form-input" type="text" id="user_phone" name="user_phone" placeholder="Số điện thoại" style="width: 110%;margin-left: 20px;">
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <select class="form-input" id="city">
                        <option value="" selected>Chọn tỉnh thành</option>
                    </select>

                    <select class="form-input" id="district">
                        <option value="" selected>Chọn quận huyện</option>
                    </select>

                    <select class="form-input" id="ward">
                        <option value="" selected>Chọn phường xã</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id="user_address_detail" class="form-input" type="text" name="user_phone" placeholder="Địa chỉ cụ thể (Số nhà,tên đường)">
                </div class="form-group">
                <label style="display:flex;">
                    <input type="checkbox" style="margin-right:10px;" value="0" id="user_address_status">
                    <div style="color:rgb(34, 34, 34,0.9);">
                        Đặt làm địa chỉ mặc định
                    </div>
                </label>
                <div class="form-group-btn">
                    <button type="button" class="form-group-btn-back" id="close-modal">Trở lại</button>
                    <button type="submit" class="form-group-btn-success">Hoàn thành</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- The Modal Sửa -->
<div id="modal_edit" class="modal" style="display: none;">
    <div class="overlay"></div>
    <div class="modal-content">
        <form id="form-edit-address" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2 style="align-items: center;display: flex;font-size: 20px;">Chỉnh sửa địa chỉ</h2>
            <div style="display:flex;width:100%;">
                <div class="form-group">
                    <input class="form-input" type="text" id="edit_user_name" name="edit_user_name" placeholder="Họ và tên" style="width: 110%;">
                </div>
                <div style="width: 16px;"></div>
                <div class="form-group">
                    <input class="form-input" type="text" id="edit_user_phone" name="edit_user_phone" placeholder="Số điện thoại" style="width: 110%;margin-left: 20px;">
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <select class="form-input" id="edit-city" name="edit_city">
                        <option value="" selected>Chọn tỉnh thành</option>
                    </select>

                    <select class="form-input" id="edit-district" name="edit_district">
                        <option value="" selected>Chọn quận huyện</option>
                    </select>

                    <select class="form-input" id="edit-ward" name="edit_ward">
                        <option value="" selected>Chọn phường xã</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id="edit_user_address_detail" class="form-input" type="text" name="edit_user_address_detail" placeholder="Địa chỉ cụ thể (Số nhà,tên đường)">
                </div class="form-group">
                <label style="display:flex;">
                    <input type="checkbox" style="margin-right:10px;" id="edit_user_address_status" name="edit_user_address_status" disabled checked>
                    <div style="color:rgb(34, 34, 34,0.9);">
                        Đặt làm địa chỉ mặc định
                    </div>
                </label>
                <div class="form-group-btn">
                    <button type="button" class="form-group-btn-back" id="close-edit-modal">Trở lại</button>
                    <button type="submit" class="form-group-btn-success">Hoàn thành</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Bật Modal-add
        $('#add-new-address').click(function(e) {
            let citis2 = document.getElementById("city");
            let districts2 = document.getElementById("district");
            let wards2 = document.getElementById("ward");
            getCity(citis2, districts2, wards2);
            $('#myModal').attr('style', 'display:flex');
        });

        // Tắt Modal-add
        $('#close-modal').click(function() {
            $('#myModal').attr('style', 'display:none');
        });

        $('.overlay').click(function() {
            $('#myModal').attr('style', 'display:none');
        });


        // Bật Modal-edit
        $('.edit-address').click(function() {
            let citis2 = document.getElementById("edit-city");
            let districts2 = document.getElementById("edit-district");
            let wards2 = document.getElementById("edit-ward");
            getCity(citis2, districts2, wards2);
            id = $(this).data('id');
            getAddressByID(id);
        });

        // Tắt Modal-edit
        $('#close-edit-modal').click(function() {
            $('#modal_edit').attr('style', 'display:none');
        });

        $('.overlay').click(function() {
            $('#modal_edit').attr('style', 'display:none');
        });

        // Get checkbox 
        // $('#user_address_status').click(function() {
        //     if ($('#user_address_status').is(':checked')) {
        //         $('#user_address_status').val(1)
        //     } else {
        //         $('#user_address_status').val(0)
        //     }
        // })

        // Add address
        $(document).ready(function() {
            $('#form-add-address').submit(function(e) {
                e.preventDefault();
                var name = $('#user_name').val();
                var phone = $('#user_phone').val();
                var city = $('#city option:selected').text();
                var district = $('#district option:selected').text();
                var ward = $('#ward option:selected').text();
                var address_detail = $('#user_address_detail').val();
                var status = 0;
                if ($('#user_address_status').is(':checked')) {
                    status = 1;
                }
                var token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{URL::to("add-address-post")}}',
                    type: 'post',
                    data: {
                        '_token': token,
                        'phone': phone,
                        'city': city,
                        'district': district,
                        'ward': ward,
                        'address_detail': address_detail,
                        'status': status,
                        'name': name,
                    },
                    success: function(res) {
                        if (res.status === 403) {
                            swal('Thông báo', res.msg, 'error');
                        }
                        if (res.status === 200) {
                            window.location.href = '/profile-address';
                        }
                    }
                });
            });
        });

        // Load Edit address
        function getAddressByID(id) {
            $.ajax({
                url: 'edit-address\/' + id,
                type: 'get',
                success: function(res) {
                    if (res.status === 403) {
                        alert(res.msg);
                    }
                    if (res.status === 200) {
                        $('#modal_edit').attr('style', 'display:flex');
                        $('#edit_user_name').val(res.data['address_shipping_name']);
                        $('#edit_user_phone').val(res.data['address_shipping_phone']);
                        $('#edit-city option').each(function(index, element) {
                            if (element.textContent == res.data['address_shipping_city']) {
                                $(this).attr('selected', true);
                                $('#edit-city option').change();
                            }
                        })
                        $('#edit-district option').each(function(index, element) {
                            if (element.textContent == res.data['address_shipping_district']) {
                                $(this).attr('selected', true);
                                $('#edit-district option').change();
                            }
                        })
                        $('#edit-ward option').each(function(index, element) {
                            if (element.textContent == res.data['address_shipping_wards']) {
                                $(this).attr('selected', true);
                                $('#edit-ward option').change();
                            }
                        })
                        $('#edit_user_address_detail').val(res.data['address_shipping_detail']);
                        $('#edit_user_address_status').val(res.data['address_shipping_status']);
                        if (res.data['address_shipping_status'] === 0) {
                            $('#edit_user_address_status').prop('checked', false);
                            $('#edit_user_address_status').attr('disabled', false);
                        } else if (res.data['address_shipping_status'] === 1) {
                            $('#edit_user_address_status').prop('checked', true);
                            $('#edit_user_address_status').attr('disabled', true);

                        }
                    }
                }
            });
        }
    });

    // Edit Address
    $(document).ready(function() {
        $('#form-edit-address').submit(function(e) {
            e.preventDefault();
            var edit_name = $('#edit_user_name').val();
            var edit_phone = $('#edit_user_phone').val();
            var edit_city = $('#edit-city option:selected').text();
            var edit_district = $('#edit-district option:selected').text();
            var edit_ward = $('#edit-ward option:selected').text();
            var edit_address_detail = $('#edit_user_address_detail').val();
            var edit_status = 0;
            if ($('#edit_user_address_status').is(':checked')) {
                edit_status = 1;
            }
            var token = $('input[name="_token"]').val();
            var edit_id = id;
            console.log(edit_id)
            $.ajax({
                url: '{{URL::to("edit-address-post")}}',
                type: 'post',
                data: {
                    '_token': token,
                    'edit_phone': edit_phone,
                    'edit_city': edit_city,
                    'edit_district': edit_district,
                    'edit_ward': edit_ward,
                    'edit_address_detail': edit_address_detail,
                    'edit_status': edit_status,
                    'edit_name': edit_name,
                    'edit_id': edit_id,
                },
                success: function(res) {
                    if (res.status === 403) {
                        swal('Thông báo', res.msg, 'error');
                    }
                    if (res.status === 200) {
                        swal('Thông báo', res.msg, 'success');
                        window.location.href = '/profile-address';
                    }
                }
            });
        });
    });

    // Change default address
    $(document).ready(function() {
        $('.change_default_address').click(function() {
            var id = $(this).data('id');
            var status = 1;
            change_default_address(id, status);
        });
    });


    function change_default_address(id, status) {
        $.ajax({
            url: 'change-default-address\/' + id + '\/' + status,
            type: 'get',
            success: function(res) {
                if (res.status === 403) {
                    swal("Thông báo", res.msg, "error");
                }
                if (res.status === 200) {
                    window.location.href = '/profile-address';
                }
            }
        });
    }

    // Delete address
    $(document).ready(function() {
        $('.profile_address_delete').click(function() {
            var id = $(this).data('id');
            swal({
                    title: "Bạn có chắc chắn xoá địa chỉ này?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                },
                function() {
                    delete_profile_address(id);
                });
        });
    });

    function delete_profile_address(id) {
        $.ajax({
            url: 'delete-profile-address\/' + id,
            type: 'get',
            success: function(res) {
                if (res.status === 403) {
                    swal("Thông báo", res.msg, "error");
                }
                if (res.status === 200) {
                    swal('Thông báo', res.msg, 'success');
                    window.location.href = '/profile-address';
                }
            }
        });
    }
</script>
@endsection