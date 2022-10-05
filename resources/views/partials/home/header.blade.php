<header class="header">
   
    <section class="flex">
 
       <a href="{{ route('home.course') }}" class="logo">E-learning</a>
 
       <form action="{{ route('home.course') }}" method="get" class="search-form">
          <input class="input" type="text" id="keyword" name="keyword" required placeholder="search courses..." maxlength="100">
          <button type="submit" class="fas fa-search"></button>
       </form>
 
       <div class="icons">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="search-btn" class="fas fa-search"></div>
          <div id="user-btn" class="fas fa-user"></div>
          <div id="toggle-btn" class="fas fa-sun" style="display: none"></div>
       </div>
 
       <div class="profile">
        @if (Session::get('name') != null)
            <img src="{{ asset("images/avatar/" . Session::get('image')) }}" class="image" alt="">
            <h3 class="name">{{ Session::get('name') }}</h3>
            <p class="role">studen</p>
            <a href="{{ route('user.myAccount') }}" class="btn">view profile</a>
            <div class="flex-btn">
                <a href="{{ route('user.logout') }}" class="option-btn">logout</a>
            </div>
        @else
         <!-- chưa đăng nhập -->
         <div class="flex-btn">
            <a href="{{ route('user.login') }}" class="option-btn">login</a>
            <a href="{{ route('user.register') }}" class="option-btn">register</a>
         </div>
         <!-- chưa đăng nhập -->
        @endif
       </div>
 
    </section>
 
 </header>  