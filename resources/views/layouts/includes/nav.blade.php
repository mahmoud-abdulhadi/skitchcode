 <nav id="main-nav" class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
  <a class="navbar-brand" href="/">
        <img src="/imgs/logo2.png" >
    {{ config('app.name', 'Laravel') }}
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active link skitches-link">
        <a class="nav-link" href="{{route('skitch.index')}}">Skitches<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item link workspaces-link">
        <a class="nav-link" href="{{route('workspace.index')}}">Workspaces</a>
      </li>
      <li class="nav-item link posts-link">
        <a class="nav-link" href="{{route('posts.index')}}">Posts</a>
      </li>
      <li class="nav-item link threads-link">
        <a class="nav-link" href="{{route('thread.index')}}">Discussions</a>
      </li>
      
    
    </ul>
    <ul class="navbar-nav ml-auto">
      @if(auth()->guest())

        <li class="nav-item">
         <a  id="search-button" href="#" class="nav-link"><span class="fa fa-search fa-lg"></span></a>
        </li>
        <li class="nav-item">
         <a  id="login-button" href="login" class="nav-link btn btn-dark nav-right-btn">Login</a>
        </li>
        <li class="nav-item">
         <a  id="register-button" href="register" class="nav-link btn btn-dark nav-right-btn">Sign Up</a>
        </li>
      @else
          @if(Auth::user()->admin)
               <li class="nav-item dropdown">
              <a  id="manage-button" class="nav-link btn btn-dark" href="#" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">Manage&nbsp;&nbsp;<span class="fa fa-wrench"></span></a>
              <div  id="manage-menu" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               <a class="dropdown-item new-item" href="/categories"><span class="fa fa-wpforms"></span> Posts Categories</a>
               <a class="dropdown-item new-item" href="/channels"><span class="fa fa-bookmark"></span> Threads Channels</a>
               <a class="dropdown-item new-item" href="/tags"><span class="fa fa-tags"></span> Tags</a>

               <a class="dropdown-item new-item" href="/users"><span class="fa fa-users"></span> Manage Users</a>
               
             </div>
               
          
        </li>


          @endif
          <li class="nav-item dropdown">
              <a id="create-button" class="nav-link btn btn-dark" href="#" id="navbarDropdown" role="button"  aria-haspopup="true" aria-expanded="false">Create&nbsp;&nbsp;<span class="fa fa-caret-down"></span></a>
              <div id="create-dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               <a class="dropdown-item new-item" href="{{route('skitch.create')}}"><span class="fa fa-code"></span> New Skitch</a>
               <a class="dropdown-item new-item" href="{{route('workspace.create')}}"><span class="fa fa-file-code-o"></span> New Workspace</a>
               <a class="dropdown-item new-item" href="/posts/create"><span class="fa fa-book"></span> New Post</a>
               <a class="dropdown-item new-item" href="/threads/create"><span class="fa fa-comments"></span> New Discussion</a>
             </div>
               
          
        </li>
        <search-play></search-play>
      
        
            <user-notifications></user-notifications>
        
       
        <li class="nav-item dropdown">
          <a id="avatar-button" class="nav-link " href="#"  role="button"  aria-haspopup="true" aria-expanded="false"><img class="avatar-img"  src="{{auth()->user()->avatar}}" alt=""></a>

          <div id="user-dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <h5 class="dropdown-header">{{auth()->user()->name}}</h5>
                 <a class="dropdown-item" href="#"><span class="fa fa-tachometer"></span> Dashboard</a>
                 <a class="dropdown-item" href="#"><span class="fa fa-user"></span> Profile</a>
                <div class="dropdown-divider"></div>
                 <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        <span class="fa fa-sign-out"></span> Logout
                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                
             </div>

        </li>
       


      @endif
    
   
  </ul>
  </div>
</nav>