@extends('layouts.app')
@section('title', '商品列表')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row products-list">
                        @foreach($products as $product)
                            <div class="col-xs-3 product-item">
                                <div class="product-content">
                                    <div class="top">
                                        <div class="img"><img src="{{ $product->image_url}}" alt=""></div>
                                        <div class="price"><b>￥</b>{{ $product->price }}</div>
                                        <div class="title">{{ $product->title }}</div>
                                    </div>
                                    <div class="bottom">
                                        <div class="sold_count">销量 <span>{{ $product->sold_count }}笔</span></div>
                                        <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pull-right">{{ $products->render() }}</div>  <!-- 只需要添加这一行 -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extends')
<style>
    .products-index-page .products-list {
        padding: 0 15px;
    }
    .products-index-page .products-list .product-item {
        padding: 0 5px;
        margin-bottom: 10px;
    }
    .products-index-page .products-list .product-item .product-content {
        border: 1px solid #eee;
    }
    .products-index-page .products-list .product-item .product-content .top {
        padding: 5px;
    }
    .products-index-page .products-list .product-item .product-content .top img {
        width: 100%;
    }
    .products-index-page .products-list .product-item .product-content .top .price {
        margin-top: 5px;
        font-size: 20px;
        color: #ff0036;
    }
    .products-index-page .products-list .product-item .product-content .top .price b {
        font-size: 14px;
    }
    .products-index-page .products-list .product-item .product-content .top .title {
        margin-top: 10px;
        height: 32px;
        line-height: 12px;
        max-height: 32px;
    }
    .products-index-page .products-list .product-item .product-content .top .title a {
        font-size: 12px;
        line-height: 14px;
        color: #333;
        text-decoration: none;
    }
    .products-index-page .products-list .product-item .product-content .bottom {
        font-size: 12px;
        display: flex;
    }
    .products-index-page .products-list .product-item .product-content .bottom .sold_count span {
        color: #b57c5b;
        font-weight: bold;
    }
    .products-index-page .products-list .product-item .product-content .bottom .review_count span {
        color: #38b;
        font-weight: bold;
    }
    .products-index-page .products-list .product-item .product-content .bottom > div {
        padding: 10px 5px;
        line-height: 12px;
        flex-grow: 1;
        border-top: 1px solid #eee;
    }
    .products-index-page .products-list .product-item .product-content .bottom > div:first-child {
        border-right: 1px solid #eee;
    }
</style>
@endsection