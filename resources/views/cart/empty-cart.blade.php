<!DOCTYPE html>
<html lang="en">

@include('assets.user.header')
<style>
    .empty-cart {
        margin-top: 40px;
        text-align: center;
        color: #6c757d;
    }

    .empty-cart .material-icons {
        font-size: 60px;
        color: #703e0b;
    }

    .empty-cart h1 {
        font-size: 24px;
        margin: 10px 0;
    }
</style>

<body>

    @include('assets.user.navbar')
    <div class="empty-cart">
        <span class="material-icons">shopping_cart</span>
        <h1>Oops! Your cart is still empty.</h1>
    </div>
    @include('home.modal')
    @include('assets.user.footer')
</body>

</html>