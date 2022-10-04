<div class="side-bar">

    <div id="close-btn">
       <i class="fas fa-times"></i>
    </div>
    <div class="profile">
        @if (Session::get('name') != null)
            <img src="{{ asset("images/avatar/" . Session::get('image')) }}" class="image" alt="">
            <h3 class="name">{{ Session::get('name') }}</h3>
            <p class="role">studen</p>
            <a href="{{ route('user.myAccount') }}" class="btn">view profile</a>
        @else
        <!-- Chưa đăng nhập -->
            <img src="{{ asset("images/avatar/avatar.png") }}" class="image" alt="">
            <h3 class="name">user</h3>
            <p class="role">Tài khoản khách</p>
            <a href="{{ route('user.login') }}" class="option-btn">login</a>
        <!-- Chưa đăng nhập -->
        @endif
    </div>
 
    <nav class="navbar">
       <a href="{{ route('home.course') }}"><i class="fas fa-home"></i><span>home</span></a>
       <a href="#"><i class="fas fa-question"></i><span>about</span></a>
       <a href="{{ route('home.myCourse') }}"><i class="fas fa-graduation-cap"></i><span>my courses</span></a>
       <a href="{{ route('home.myCart') }}"><i class="fa-solid fa-cart-shopping"></i><span>my cart</span></a>
       <a href="#"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
       <a href="#"><i class="fas fa-headset"></i><span>contact us</span></a>
    </nav>
 
 </div>