{{View::make('pages.header')}}
{{View::make('pages.navbar')}}
</header>
<?php

use Illuminate\Support\Facades\Session;
?>
<style>
    .body {
        line-height: 1.2rem;
        color: rgba(0, 0, 0, .8);
    }

    .navbar__info {
        display: flex;
    }

    .navbar__info-img {
        width: 48px;
        height: 48px;
    }

    .navbar__info-name {
        margin: 0;
        font-size: 1.5rem;
        vertical-align: middle;
        padding-left: 0.3125rem
    }

    .navbar__info-name>h3 {
        margin-top: 18px;
        margin-bottom: 10px;
        margin-left: 10px;
    }

    .navbar__category {
        font-weight: 400;
    }


    .my_info:hover {
        color: #FE980F;
    }

    .my_info--active {
        color: #FE980F;
    }

    .content__info {
        padding: 10px 15px;

    }

    .content__info-header-profile {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
    }

    .content__info-header-address {
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        display: flex;
        justify-content: space-between;
    }

    .content__info-form,
    .content__address-form {
        display: flex;
    }

    .input-group {
        padding: 20px 0;
        display: flex;

    }

    .input-group h5 {
        flex: 1;
    }

    .input-group>input,
    .input-group>div {
        flex: 2;
    }

    .user-email {
        display: flex;

    }

    .radio-group>label,
    .radio-group>label>input {
        margin-right: 10px;
        cursor: pointer;
    }

    .btn-change-profile {
        background-color: #FE980F;
        color: #fff;
        border: 0;
        height: 40px;
        min-width: 70px;
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 9%);
        border-radius: 2px;
        cursor: pointer;
        margin-bottom: 60px;
        margin-left: 190px;
        margin-top: 20px;
    }

    .content__info-avatar {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .btn-change-avatar {
        background: #fff;
        color: #555;
        border: 1px solid rgba(0, 0, 0, .09);
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 3%);
        height: 40px;
        padding: 0 20px;
    }

    /* CSS with địa chỉ */
    .btn-with-icon {
        margin-top: 15px;
        background-color: #FE980F;
        display: flex;
        justify-content: space-between;
    }

    .btn-change-address {
        background-color: #FE980F;
        border: none;
    }

    .content__address-change {
        display: flex;
        justify-content: flex-end;
        margin: 8px 0;
    }

    .content__address-btn {
        display: inline-block;
        border: 0;
        background: none;
        outline: none;
        text-decoration: underline;
        padding: 7px 0;
        color: #555;
    }

    .content__address-change-btn {
        float: right;
        padding: 8px 14px;
        height: auto;
        margin-top: 10px;
        border: 1px solid rgba(0, 0, 0, .09);
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 3%);
    }

    .content__address-change-btn:hover {
        border: 1px solid rgba(0, 0, 0, 1);
    }

    .btn-light--disabled {
        background: #fff !important;
        color: #ccc;
        pointer-events: none;

    }

    /* Modal địa chỉ */
    .overlay {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: black;
        opacity: 0.2;
    }

    .modal-content {
        width: 500px;
        margin: auto;
        padding: 30px;
    }

    .form-input {
        display: flex;
        align-items: center;
        background-color: rgb(255, 255, 255);
        position: relative;
        border-radius: 2px;
        border: 1px solid rgba(0, 0, 0, 0.14);
        box-sizing: border-box;
        box-shadow: rgb(0 0 0 / 2%) 0px 2px 0px 0px inset;
        color: rgb(34, 34, 34);
        height: 40px;
        padding: 10px;
        outline: none;
        width: 100%;
        margin-bottom: 25px;
    }

    .form-group {
        margin: 0;
    }

    .form-group-btn {
        position: relative;
        display: flex;
        justify-content: flex-end;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(hsla(0, 0%, 100%, .7), #fff);
        height: 40px;
    }

    .form-group-btn-back {
        outline: none;
        padding: 10px;
        border: 0;
        background: none;
        border-radius: 2px;
        text-transform: uppercase;
        min-width: 140px;
        font-size: 14px;
        cursor: pointer;
    }

    .form-group-btn-success {
        outline: none;
        padding: 10px;
        border: 0;
        background: none;
        border-radius: 2px;
        text-transform: uppercase;
        min-width: 140px;
        font-size: 14px;
        cursor: pointer;
        color: #fff;
        background-color: #FE980F;
    }


    .btn-address-default {
        justify-content: center;
        background: #00bfa5;
        color: #fff;
        border-radius: 4px;
        padding: 0 8px;
        font-size: 1.2rem;
        font-weight: 500;
        line-height: 24px;
        height: 24px;
        white-space: nowrap;
    }

    /* Đơn mua */
    .content__mypurchase {
        min-height: 740px;
        box-shadow: 0 0 0 2px #f5f5f5;
        padding-top: 20px;
        padding-bottom: 50px;
    }

    .content__mypurchase-header {
        width: 100%;
        margin-bottom: 12px;
        display: flex;
        overflow: hidden;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 10;
        background: #fff;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
    }

    .mypurchase_header {
        cursor: pointer;
        padding: 15px 0;
        font-size: 16px;
        line-height: 19px;
        text-align: center;
        color: rgba(0, 0, 0, .8);
        background: #fff;
        border-bottom: 2px solid rgba(0, 0, 0, .09);
        display: flex;
        flex: 1;
        overflow: hidden;
        justify-content: center;
        transition: color .2s;
    }

    .search-mypurchase {
        padding: 12px 0;
        margin: 12px 0;
        display: flex;
        align-items: center;
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%);
        color: #212121;
        background: #eaeaea;
        border-radius: 2px;
    }

    .content_mypurchase-container {
        width: 100%;
        text-align: center;
    }

    .mypurchase-container {
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%);
        border-radius: 0.125rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background: #fff;
    }

    .image-nopurchase {
        background-position: 50%;
        background-size: contain;
        background-repeat: no-repeat;
        width: 100px;
        height: 100px;
        background-image: url(https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/5fafbb923393b712b96488590b8f781f.png);
    }

    .mypurchase_header:hover {
        color: #FE980F;
        border-bottom: 1px solid #FE980F;
    }

    .mypurchase_header--active {
        border-bottom: 1px solid #FE980F;
        color: #FE980F;
    }

    /* purchase all */
    .content_mypurchase-container {
        padding-bottom: 10px;
    }

    .content_mypurchase-order {
        padding: 16px 20px;
        border-bottom: 1px solid #eaeaea;
        border-top: 1px solid #eaeaea;
        margin: 12px 0;
    }

    .mypurchase_product {
        padding: 0;
    }

    .mypurchase_product>li {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .product_image {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .info_product {
        width: 80%;
        text-align: left;
        margin-left: 10px;
    }

    .info_product>h2 {
        font-size: 1.8rem;
        font-weight: 500;
        margin: 0;
    }

    .info_product>h3 {
        margin: 5px 0;
        font-size: 1.2rem;
        color: #666;
    }

    .info_product>h4 {
        margin: 5px 0;
        font-size: 1.4rem;
    }

    .price_product {
        width: 10%;
        color: #e93c3c;
        margin-top: 20px;
        margin-right: 8px;
    }

    .total {
        display: flex;
        justify-content: flex-end;
        margin-right: 8px;
    }

    .total-span {
        font-size: 1.6rem;
        font-weight: 500;
        margin-right: 5px;
        text-align: center;
    }

    .total-order {
        color: #e93c3c;
        font-size: 30px;
    }

    .repurchase,
    .stardust-button-status {
        background-color: #FE980F;
        color: white;
        width: 130px;
        line-height: 25px;
    }

    .product-detail {
        line-height: 25px;
    }

    .desc-order {
        padding: 12px 10px;
    }

    /* Product-detail */
    .Product_detail {
        position: relative;
        flex-grow: 1;
        box-sizing: border-box;
        min-width: 0;
        background: #fff;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 13%);
        border-radius: 0.125rem;
    }

    .product_detail_header {
        padding: 20px 24px;
        font-size: 14px;
        line-height: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ccc;
        margin-top: 10px;
    }



    .product_detail_content {
        padding: 40px 24px;
    }

    .product_detail_stepper {
        position: relative;
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .stepper__step {
        width: 140px;
        text-align: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        cursor: default;
        z-index: 1;
    }

    .stepper__step-icon {
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        margin: auto;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 1.875rem;
        border: 4px solid #e0e0e0;
        color: #e0e0e0;
        background-color: #fff;
        transition: background-color .3s cubic-bezier(.4, 0, .2, 1) .7s, border-color .3s cubic-bezier(.4, 0, .2, 1) .7s, color .3s cubic-bezier(.4, 0, .2, 1) .7s;
    }

    .stepper__step--finish {
        border-color: #2dc258;
        color: #2dc258;
    }

    .stepper__step-icon--finish {
        border-color: #2dc258;
        color: #2dc258;
    }

    .icon-order-order,
    .icon-order-paid,
    .icon-order-shipping,
    .icon-order-problem,
    .icon-order-received {
        stroke: currentColor;
    }

    .shopee-svg-icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        fill: currentColor;
        position: relative;
    }

    .stepper__step-text {
        text-transform: capitalize;
        font-size: 1.4rem;
        color: rgba(0, 0, 0, .8);
        line-height: 1.8rem;
        margin: 12px 0 2px;
    }

    .stepper__step-date {
        font-size: 1.2rem;
        color: rgba(0, 0, 0, .26);
        height: 1rem;
        margin-top: 5px;
    }

    .stepper__step-icon--pending {
        background-color: #2dc258;
        color: #fff;
        fill: #2dc258;
        border-color: #2dc258;
        stroke: currentColor;
    }

    .icon-order-rating {
        stroke: currentColor;
    }

    .stepper__line {
        position: absolute;
        top: 29px;
        height: 4px;
        width: 100%;
    }

    .stepper__line-background,
    .stepper__line-foreground {
        position: absolute;
        width: calc(100% - 140px);
        margin: 0 70px;
        height: 100%;
        box-sizing: border-box;
    }

    .bbL\+1w:first-child {
        border: 0;
    }

    .bbL\+1w {
        padding: 12px 24px;
        flex-wrap: nowrap;
        justify-content: space-between;
        box-sizing: border-box;
        background-color: #fffcf5;
        display: flex;
        align-items: center;
    }

    .SfqFiN {
        flex-wrap: nowrap;
        justify-content: space-between;
        box-sizing: border-box;
        background-color: #fffcf5;
        padding-right: 10px;
    }

    .stardust-button {
        width: 220px;
    }

    .stardust-button--primary {
        background-color: #FE980F;
        border-color: #fff;
    }

    .stardust-button--primary:hover {
        background-color: #FE980F;
    }

    .Kz9HeM {
        min-width: 150px;
        min-height: 40px;
        padding: 8px 20px;
        text-transform: capitalize;
        border-radius: 2px;
        outline: 0;
        color: #fff;
    }

    .Kz9HeM,
    .Kz9HeM:hover {
        border: 1px solid transparent;
    }

    .JNf2c8 {
        padding: 3px 0;
    }

    .r3nkAD {
        height: 0.1875rem;
        width: 100%;
        background-position-x: -1.875rem;
        background-size: 7.25rem 0.1875rem;
        background-image: repeating-linear-gradient(45deg, #6fa6d6, #6fa6d6 33px, transparent 0, transparent 41px, #f18d9b 0, #f18d9b 74px, transparent 0, transparent 82px);
    }

    .rU5kQ6 {
        padding: 20px 24px 24px;
    }

    .ASGNe9 {
        padding: 0 0 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .ver7Tm {
        text-transform: capitalize;
        color: rgba(0, 0, 0, .8);
        font-size: 20px;
        line-height: 24px;
        font-weight: 500;
    }

    .RKBD1x {
        display: flex;
    }

    .ikpx1p {
        max-width: 100%;
        padding: 10px 24px 0 0;
        line-height: 22px;
        flex: 1;
    }

    .D\+2WM2 {
        max-width: 100%;
        margin: 0 0 7px;
        overflow: hidden;
        text-overflow: ellipsis;
        color: rgba(0, 0, 0, .8);
        font-weight: 400;
    }

    .IqSKNq {
        color: rgba(0, 0, 0, .70);
        font-size: 12px;
    }

    .w5KHDc {
        width: 620px;
        padding: 4px 0 0 24px;
        border-left: 1px solid rgba(0, 0, 0, .09);
    }

    .Wo2MM5 {
        position: relative;
    }

    .VLmetq {
        width: 1px;
        height: 100%;
        position: absolute;
        top: 12px;
        left: 5px;
        background: #d8d8d8;
    }

    .oejwON {
        width: 11px;
        height: 11px;
        margin: 11px 8px 0 0;
        flex-shrink: 0;
        z-index: 1;
        border-radius: 50%;
        background: #d8d8d8;
    }

    .iMSI13 {
        display: flex;
        align-items: flex-start;
        flex-wrap: nowrap;
        color: rgba(0, 0, 0, .54);
        font-size: 14px;
        line-height: 32px;
    }

    .Wo2MM5:first-child .oejwON {
        background: #26aa99;
    }

    ._15h9PB {
        width: 120px;
        margin: 0 4px px 0 0;
        flex-shrink: 0;
        color: rgba(0, 0, 0, .8);
    }

    .Wo2MM5:first-child .iMSI13 {
        color: #26aa99;
    }

    .QkIuzE {
        display: flex;
        padding: 12px 0 12px;
        align-items: center;
        flex-wrap: nowrap;
        color: rgba(0, 0, 0, .87);
    }

    .QZ4vFF {
        background-color: #fafafa;
        border-top: 1px solid rgba(0, 0, 0, .09);
    }

    [dir=ltr] .MqHNeD {
        text-align: right;
    }

    .MqHNeD {
        padding: 0 24px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        border-bottom: 1px dotted rgba(0, 0, 0, .09);
    }

    .vXeTuK {
        padding: 13px 10px;
        color: rgba(0, 0, 0, .54);
        font-size: 14px;
        display: flex;
    }

    ._30Hj4X {
        padding: 13px 0 13px 10px;
        width: 240px;
        border-left: 1px dotted rgba(0, 0, 0, .09);
        justify-content: flex-end;
        word-wrap: break-word;
        color: rgba(0, 0, 0, .8);
        display: flex;
    }

    .QFUBut {
        background-color: #fafafa;
    }

    .PbUiaK {
        line-height: 0;
        cursor: pointer;
    }

    .HFmUTM {
        vertical-align: text-top;
        line-height: 14px;
    }

    .fqySNq {
        color: #ee4d2d;
        font-size: 24px;
    }

    .hDGdsD {
        padding: 0 12px 0 0;
        flex: 1;
        align-items: flex-start;
        flex-wrap: nowrap;
        display: flex;
    }

    ._50XPwl {
        width: 80px;
        height: 80px;
        flex-shrink: 0;
    }

    .tODfT4 {
        min-width: 0;
        padding: 0 0 0 12px;
        display: flex;
        flex: 1;
        flex-direction: column;
        align-items: flex-start;
        word-wrap: break-word;
    }

    .QJqUaT {
        overflow: hidden;
        display: -webkit-box;
        text-overflow: ellipsis;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        margin: 0 0 5px;
        font-size: 16px;
        line-height: 22px;
        max-height: 48px;
    }

    .WVc4Oc {
        vertical-align: middle;
    }

    .qGisqd {
        margin: 0 0 5px;
    }

    .z1upOh {
        padding: 12px 24px;
        background-color: #fafafa;
    }

    /* Modal xác nhận */
    .modal_confirm {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        z-index: 999999999;
    }

    .stardust-popup__overlay {
        width: 100%;
        height: 100%;
        background-color: #000;
        opacity: 0.4;
        position: absolute;
        z-index: 1;
    }

    .stardust-popup {
        width: 500px;
        background-color: #fff;
        margin: auto;
        z-index: 9999999999999999 !important;
        position: relative;
        padding: 30px 30px;
    }

    .stardust-popup-content {
        font-size: 15px;
        text-align: left;
        color: rgba(0, 0, 0, .54);
    }

    .stardust-popup-buttons {
        margin: 30px 12px 0 30px;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }

    .stardust-popup-button {
        flex: 0 1 6.25rem;
        margin-left: 1rem;
        line-height: 14px;
        border-radius: 0.125rem;
        font-size: 14px;
        border: 0.0625rem solid rgba(0, 0, 0, .09);
        box-shadow: 0 0.0625rem 0.0625rem 0 rgb(0 0 0 / 3%);
        white-space: nowrap;
        padding: 10px;
        cursor: pointer;
        user-select: none;
    }

    .stardust-popup-button--secondary {
        background: #fff;
        color: rgba(0, 0, 0, .87);
        text-transform: uppercase;
        border: 0;
    }

    .stardust-popup-button--secondary:hover {
        background: rgba(0, 0, 0, .02);
        border-color: rgba(0, 0, 0, .09);
    }

    .stardust-popup-button--main {
        background: #FE980F;
        color: #fff;
        text-transform: uppercase;
    }

    .stardust-popup-button--main:hover {
        background: #FE980F;
        filter: brightness(110%);
    }

    /* Change password */
    .xMDeox {
        position: relative;
        flex-grow: 1;
        width: 928px;
        box-sizing: border-box;
        margin-left: 1.6875rem;
        min-width: 0;
        background: #fff;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 13%);
        border-radius: 0.125rem;
    }

    .Hvae38 {
        display: flex;
        flex-direction: column;
        position: relative;
        min-height: 100%;
    }

    .DQHtXe {
        padding: 0 30px 10px;
    }

    .FUOi1p {
        border-bottom: 0.0625rem solid #efefef;
        padding: 0.5rem 0;
    }

    .DSKSYU {
        font-size: 2.0rem;
        font-weight: 500;
        line-height: 1.8rem;
        text-transform: capitalize;
        color: #333;
    }

    .tk-R8Z {
        font-size: 1.4rem;
        line-height: 1.4rem;
        color: #555;
    }

    .fo5IeT {
        padding-top: 1.5625rem;
        flex-direction: column;
        display: flex;
        align-items: center;
    }

    .Kuz0mN {
        width: 50rem;
        display: flex;
        align-items: center;
    }

    .A8yLgM {
        width: 100%;
        margin-bottom: 0.9375rem;
        border-radius: 0.125rem;
    }

    .ltFKuQ {
        display: flex;
        align-items: center;
    }

    .op-21F {
        text-align: right;
        width: 30%;
    }

    .mlaS58 {
        width: 150px;
        color: #757575;
        text-transform: capitalize;
        text-align: right;
    }

    .iqUYOb {
        width: 400px;
        box-sizing: border-box;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        display: flex;
    }

    .kpK-3W {
        width: 100%;
    }

    .-wQUjw {
        padding: 0.625rem;
        box-sizing: border-box;
        outline: none;
        border: 1px solid rgba(0, 0, 0, .14);
        height: 33px;
    }

    ._7vstgM {
        color: #757575;
        outline: none;
        border: 0;
        background-color: #fff;
        text-transform: none;
        margin-right: 74px;
        margin-top: 10px;
    }

    .RlzsL7 {
        display: flex;
        justify-content: flex-end;
        width: 20%;
    }

    .btn-change-password {
        background-color: #FE980F;
        color: #fff;
        border: 0;
        height: 40px;
        min-width: 70px;
        box-shadow: 0 1px 1px 0 rgb(0 0 0 / 9%);
        border-radius: 2px;
        cursor: pointer;
        margin-bottom: 60px;
        margin-left: 50px;
        margin-top: 20px;
    }

    .btn-change-password:hover {
        color: #fff;
    }

    .vuqET4 {
        display: flex;
        width: 50%;
        box-sizing: border-box;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-2" style="padding:15px;">
            <div class="navbar__info">
                @if($get_info_user->avatar!=null)
                <img src="{{URL::to('public/upload/image_user/'.$get_info_user->avatar)}}" alt="" class="navbar__info-img">
                @else
                <img src="{{URL::to('public/upload/image_user/avatar_default.jpg')}}" alt="" class="navbar__info-img">
                @endif
                <h3 style="margin-top: 18px;font-size:1.4rem;margin-bottom: 10px;margin-left: 10px;">{{$get_info_user->user_login}}</h3>
            </div>
            <div class="navbar__category body-tab" style="cursor:pointer;">
                <div class="my_info_menu" style="font-size:14px;margin: 7px 0 0 0;border-top:1px solid #ccc;">
                    <div class="my_info my_info_item_menu" style="margin-top:10px;display:flex;">
                        <img src="https://cf.shopee.vn/file/ba61750a46794d8847c3f463c5e71cc4" style="width:20px;height:20px;margin-right:10px;">
                        <h3 style="margin-top: 4px;font-size:14px;margin-bottom:15px;">Tài khoản của tôi</h3>
                    </div>
                    <ul style="padding: 0 32px;margin: 0; " class=" my_info_sub_menu">
                        <li id="my_info" class="my_info ajax-select my_info--active" data-ajax="/profile-info" style="padding-bottom:5px;">
                            Hồ Sơ
                        </li>
                        <li class="my_info" style="padding-bottom:5px;">Ngân Hàng</li>
                        <li class="my_info ajax-select" data-ajax="/profile-address" style="padding-bottom:5px;">
                            Địa Chỉ
                        </li>
                        <li class="my_info ajax-select" style="padding-bottom:12px;" data-ajax="/profile-password">Đổi Mật Khẩu</li>
                    </ul>
                </div>
                <div style="margin-bottom:15px;display:flex;" class="my_info body-my-purchase">
                    <img src="https://cf.shopee.vn/file/f0049e9df4e536bc3e7f140d071e9078" style="width:20px;height:20px;margin-right:10px;">
                    <div id="my_purchase" class="ajax_my_purchase ajax-select" data-ajax="/my-purchase-status/-1">Đơn mua</div>
                </div>
                <div class="my_info"><img src="https://cf.shopee.vn/file/e10a43b53ec8605f4829da5618e0717c" style="width:20px;height:20px;margin-right:10px;">Thông báo</div>
            </div>
        </div>
        <div class="col-sm-10" id="content_profile_user">
            @yield('profile_content')
        </div>
    </div>
</div>


<!-- Load data ajax -->
<script>
    $(document).ready(function() {
        // Load hồ sơ pjax
        $('.body-tab .ajax-select').click(function() {
            $.pjax({
                url: $(this).data('ajax'),
                type: 'get',
                container: '#content_profile_user',
                timeout: 9000000,
            })
        })
        $(document).on('pjax:error', function(event, data, status, xhr, options) {
            swal('Thông báo', 'Gặp sự cố khi tải lên dự liệu, vui lòng tải lại trang!', 'warning')
        });
    })

    $('.my_info').click(function() {
        remove_active_myinfo();
        $(this).addClass('my_info--active');
    });

    function remove_active_myinfo() {
        $('.my_info--active').removeClass('my_info--active');
    }

    jQuery.fn.extend({
        setMenu: function() {
            return this.each(function() {
                var container_menu = $(this);

                var item_menu = container_menu.find('.my_info_item_menu');
                item_menu.click(function() {
                    var sub_menu_item = container_menu.find('.my_info_sub_menu');
                    sub_menu_item.slideToggle(500);

                });

                $(this).closest('.navbar__category').find('.my_info').click(function(e) {
                    if (!container_menu.is(e.target) &&
                        container_menu.has(e.target).length === 0) {
                        var isopened = container_menu.find('.my_info_sub_menu').css("display");

                        if (isopened == 'block') {
                            container_menu.find('.my_info_sub_menu').slideToggle(500);
                        }
                    }
                });
            });
        },

    });
    $('.my_info_menu').setMenu();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js?123"></script>
<script src="{{asset('fontend/js/app_edit.js')}}"></script>
{{View::make('pages.footer')}}