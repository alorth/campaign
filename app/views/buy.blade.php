@extends('layout')

@section('body')    

    <div class="col-md-6 col-md-offset-3">
        <header class="page-header">
            <h2>請填寫資料完成購買</h2>
        </header>
        <form action="{{ URL::to('/buy') }}" method="post">
            <div class="form-group">
                <label for="product">商品</label>
                <input type="text" class="form-control" id="product" name="product" readonly 
                    value="{{ $title }}">
            </div>

            <div class="form-group">
                <label for="price">價格</label>
                <input type="number" class="form-control" id="price" name="price" readonly 
                    value="{{ $price }}">
            </div>


            <div class="form-group">
                <label for="number">訂購數量</label>
                <input type="number" class="form-control" id="number" name="number" value=1>
            </div>

            <div class="form-group">
                <label for="other">其他需求，例如 : 大小、顏色</label>
                <input type="text" class="form-control" id="other" name="other" placeholder="">
            </div>            

            <div class="form-group">
                <label for="name">收件人</label>
                <input type="text" class="form-control" id="name" name="name" 
                    placeholder="王小明">
            </div>

            <div class="form-group">
                <label for="email">電子信箱</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="phone">手機號碼</label>
                <input type="text" class="form-control" id="phone" name="phone" 
                    placeholder="09xx-xxx-xxx">
            </div>

            <div class="form-group">
                <label for="ship">宅配方式</label>
                <input type="text" class="form-control" id="ship" name="ship" value="貨到付款" readonly>
            </div>

            <div class="form-group">
                <label for="address">地址</label>
                <input type="address" class="form-control" id="address" name="address" placeholder="台北市 . . .">
            </div>

            
            <button type="submit" class="btn btn-default">送出</button>
        </form>
    </div>

@stop