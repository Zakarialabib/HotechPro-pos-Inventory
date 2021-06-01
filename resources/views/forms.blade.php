<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header flex items-center justify-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center"><img src="img/avatar-1.jpg" alt="person" class="max-w-full h-auto rounded-full">
            <h2 class="h5">Anderson Hardy</h2><span>Web Developer</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-blue-600">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="index.html"> <i class="icon-home"></i>Home                             </a></li>
            <li class="active"><a href="forms.html"> <i class="icon-form"></i>Forms                             </a></li>
            <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts                             </a></li>
            <li><a href="tables.html"> <i class="icon-grid"></i>Tables                             </a></li>
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="hidden list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
            <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page                             </a></li>
            <li> <a href="#"> <i class="icon-mail"></i>Demo
                <div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">6 New</div></a></li>
          </ul>
        </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading">Second menu</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
            <li> <a href="#"> <i class="icon-flask"> </i>Demo
                <div class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-teal-500 text-white hover:bg-teal-600">Special</div></a></li>
            <li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>
            <li> <a href=""> <i class="icon-picture"> </i>Demo</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="relative flex flex-wrap items-center content-between py-3 px-4">
          <div class="mx-auto px-2 max-w-full mx-auto">
            <div class="navbar-holder flex items-center justify-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="inline-block pt-1 pb-1 mr-4 text-lg whitespace-no-wrap">
                  <div class="brand-text hidden md:inline-block"><span>Bootstrap </span><strong class="text-blue-600">Dashboard</strong></div></a></div>
              <ul class="nav-menu list-unstyled flex md:flex-row md:items-center">
                <li class=" relative"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="inline-block py-2 px-4 no-underline"><i class="fa fa-bell"></i><span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-orange-400 text-black hover:bg-orange-500">12</span></a>
                  <ul aria-labelledby="notifications" class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded">
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"> 
                        <div class="notification flex justify-between">
                          <div class="notification-content"><i class="dripicons-mail"></i>You have 6 new messages </div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"> 
                        <div class="notification flex justify-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"> 
                        <div class="notification flex justify-between">
                          <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                          <div class="notification-time"><small>4 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0"> 
                        <div class="notification flex justify-between">
                          <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                          <div class="notification-time"><small>10 minutes ago</small></div>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                  </ul>
                </li>
                <li class=" relative"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="inline-block py-2 px-4 no-underline"><i class="dripicons-mail"></i><span class="inline-block p-1 text-center font-semibold text-sm align-baseline leading-none rounded bg-teal-500 text-white hover:bg-teal-600">10</span></a>
                  <ul aria-labelledby="notifications" class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded">
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 flex"> 
                        <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="max-w-full h-auto rounded-full"></div>
                        <div class="msg-body">
                          <h3 class="h5">Jason Doe</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 flex"> 
                        <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="max-w-full h-auto rounded-full"></div>
                        <div class="msg-body">
                          <h3 class="h5">Frank Williams</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 flex"> 
                        <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="max-w-full h-auto rounded-full"></div>
                        <div class="msg-body">
                          <h3 class="h5">Ashley Wood</h3><span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                        </div></a></li>
                    <li><a rel="nofollow" href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0 all-notifications text-center"> <strong> <i class="dripicons-mail"></i>Read all messages    </strong></a></li>
                  </ul>
                </li>
                <li class=""><a href="login.html" class="inline-block py-2 px-4 no-underline logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="mx-auto px-2 max-w-full mx-auto">
          <ul class="flex flex-wrap list-reset pt-3 pb-3 py-4 px-4 mb-4 bg-gray-200 rounded">
            <li class="inline-block px-2 py-2 text-gray-700"><a href="index.html">Home</a></li>
            <li class="inline-block px-2 py-2 text-gray-700 active">Forms       </li>
          </ul>
        </div>
      </div>
      <section class="forms">
        <div class="mx-auto px-2 max-w-full mx-auto">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Forms            </h1>
          </header>
          <div class="flex flex-wrap ">
            <div class="md:w-1/2 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>Basic Form</h4>
                </div>
                <div class="flex-auto p-6">
                  <p>Lorem ipsum dolor sit amet consectetur.</p>
                  <form>
                    <div class="mb-4">
                      <label>Email</label>
                      <input type="email" placeholder="Email Address" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                    </div>
                    <div class="mb-4">       
                      <label>Password</label>
                      <input type="password" placeholder="Password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                    </div>
                    <div class="mb-4">       
                      <input type="submit" value="Signin" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="md:w-1/2 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>Horizontal Form</h4>
                </div>
                <div class="flex-auto p-6">
                  <p>Lorem ipsum dolor sit amet consectetur.</p>
                  <form class="form-horizontal">
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4">Email</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input id="inputHorizontalSuccess" type="email" placeholder="Email Address" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded form-control-success"><small class="block mt-1">Example help text that remains unchanged.</small>
                      </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4">Password</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input id="inputHorizontalWarning" type="password" placeholder="Pasword" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded form-control-warning"><small class="block mt-1">Example help text that remains unchanged.</small>
                      </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">       
                      <div class="sm:w-4/5 pr-4 pl-4 sm:mx-1/5">
                        <input type="submit" value="Signin" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="md:w-2/3 pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>Inline Form</h4>
                </div>
                <div class="flex-auto p-6">
                  <form class="flex items-center">
                    <div class="mb-4">
                      <label for="inlineFormInput" class="sr-only">Name</label>
                      <input id="inlineFormInput" type="text" placeholder="Jane Doe" class="mr-3 block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                    </div>
                    <div class="mb-4">
                      <label for="inlineFormInputGroup" class="sr-only">Username</label>
                      <input id="inlineFormInputGroup" type="text" placeholder="Username" class="mr-3 block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                    </div>
                    <div class="mb-4">
                      <input type="submit" value="Submit" class="mr-3 inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="sm:1/2 md:w-1/3 lg:w-1/4 px-2">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>Modal Form</h4>
                </div>
                <div class="flex-auto p-6 text-center">
                  <button type="button" data-toggle="modal" data-target="#myModal" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">Form in simple modal </button>
                  <!-- Modal-->
                  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal opacity-0 text-left">
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Signin Modal</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="absolute top-0 bottom-0 right-0 px-4 py-3"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                        </div>
                        <div class="modal-body">
                          <p>Lorem ipsum dolor sit amet consectetur.</p>
                          <form>
                            <div class="mb-4">
                              <label>Email</label>
                              <input type="email" placeholder="Email Address" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                            </div>
                            <div class="mb-4">       
                              <label>Password</label>
                              <input type="password" placeholder="Password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                            </div>
                            <div class="mb-4">       
                              <input type="submit" value="Signin" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" data-dismiss="modal" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">Close</button>
                          <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="md:w-full pr-4 pl-4">
              <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900 flex items-center">
                  <h4>All form elements</h4>
                </div>
                <div class="flex-auto p-6">
                  <form class="form-horizontal">
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Normal</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Help text</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"><span class="text-small text-gray help-block-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Password</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input type="password" name="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Placeholder</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input type="text" placeholder="placeholder" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="md:w-1/5 pr-4 pl-4 form-control-label">Disabled</label>
                      <div class="md:w-4/5 pr-4 pl-4">
                        <input type="text" disabled="" placeholder="Disabled input here..." class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Checkboxes and radios <br><small class="text-blue-600">Normal Bootstrap elements</small></label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div>
                          <input id="option" type="checkbox" value="">
                          <label for="option">Option one is this and that—be sure to include why it's great</label>
                        </div>
                        <div>
                          <input id="optionsRadios1" type="radio" checked="" value="option1" name="optionsRadios">
                          <label for="optionsRadios1">Option one is this and that be sure to include why it's great</label>
                        </div>
                        <div>
                          <input id="optionsRadios2" type="radio" value="option2" name="optionsRadios">
                          <label for="optionsRadios2">Option two can be something else and selecting it will deselect option one</label>
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Inline checkboxes</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <label class="checkbox-inline">
                          <input id="inlineCheckbox1" type="checkbox" value="option1"> a
                        </label>
                        <label class="checkbox-inline">
                          <input id="inlineCheckbox2" type="checkbox" value="option2"> b
                        </label>
                        <label class="checkbox-inline">
                          <input id="inlineCheckbox3" type="checkbox" value="option3"> c
                        </label>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Checkboxes &amp; radios <br><small class="text-blue-600">Custom elements</small></label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="i-checks">
                          <input id="checkboxCustom1" type="checkbox" value="" class="form-control-custom">
                          <label for="checkboxCustom1">Option one</label>
                        </div>
                        <div class="i-checks">
                          <input id="checkboxCustom2" type="checkbox" value="" checked="" class="form-control-custom">
                          <label for="checkboxCustom2">Option two checked</label>
                        </div>
                        <div class="i-checks">
                          <input id="checkboxCustom" type="checkbox" value="" disabled="" checked="" class="form-control-custom">
                          <label for="checkboxCustom">Option three checked and disabled</label>
                        </div>
                        <div class="i-checks">
                          <input id="checkboxCustom3" type="checkbox" value="" disabled="" class="form-control-custom">
                          <label for="checkboxCustom3">Option four disabled</label>
                        </div>
                        <div class="i-checks">
                          <input id="radioCustom1" type="radio" value="option1" name="a" class="form-control-custom radio-custom">
                          <label for="radioCustom1">Option one</label>
                        </div>
                        <div class="i-checks">
                          <input id="radioCustom2" type="radio" checked="" value="option2" name="a" class="form-control-custom radio-custom">
                          <label for="radioCustom2">Option two checked</label>
                        </div>
                        <div class="i-checks">
                          <input id="radioCustom3" type="radio" disabled="" checked="" value="option2" class="form-control-custom radio-custom">
                          <label for="radioCustom3">Option three checked and disabled</label>
                        </div>
                        <div class="i-checks">
                          <input id="radioCustom4" type="radio" disabled="" name="a" class="form-control-custom radio-custom">
                          <label for="radioCustom4">Option four disabled</label>
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Select</label>
                      <div class="sm:w-4/5 pr-4 pl-4 mb-3">
                        <select name="account" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                        </select>
                      </div>
                      <div class="sm:w-4/5 pr-4 pl-4 sm:mx-1/5">
                        <select multiple="" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                        </select>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap  has-success">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Input with success</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded bg-green-700">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap  has-danger">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Input with error</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded bg-red-700">
                        <div class="hidden mt-1 text-sm text-red">Please provide your name.</div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Control sizing</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="mb-4">
                          <input type="text" placeholder=".input-lg" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-2 px-4 text-lg leading-normal rounded">
                        </div>
                        <div class="mb-4">
                          <input type="text" placeholder="Default input" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                        </div>
                        <div class="mb-4">
                          <input type="text" placeholder=".input-sm" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded">
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Column sizing</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="flex flex-wrap ">
                          <div class="md:w-1/5 pr-4 pl-4">
                            <input type="text" placeholder=".col-md-2" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                          <div class="md:w-1/4 pr-4 pl-4">
                            <input type="text" placeholder=".col-md-3" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                          <div class="sm:1/2 md:w-1/3 lg:w-1/4 px-2">
                            <input type="text" placeholder=".col-md-4" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="line"> </div>
                    <div class="flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Material Inputs</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="form-group-material">
                          <input id="register-username" type="text" name="registerUsername" required class="input-material">
                          <label for="register-username" class="label-material">Username</label>
                        </div>
                        <div class="form-group-material">
                          <input id="register-email" type="email" name="registerEmail" required class="input-material">
                          <label for="register-email" class="label-material">Email Address      </label>
                        </div>
                        <div class="form-group-material">
                          <input id="register-password" type="password" name="registerPassword" required class="input-material">
                          <label for="register-password" class="label-material">Password                                                      </label>
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Input groups</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                            <input type="text" placeholder="Username" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                        </div>
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                          </div>
                        </div>
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                            <div class="input-group-append"><span class="input-group-text">.00</span></div>
                          </div>
                        </div>
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox">
                              </div>
                            </div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                        </div>
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="radio">
                              </div>
                            </div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">Button addons</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <div class="input-group-prepend">
                              <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">Go!</button>
                            </div>
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                          </div>
                        </div>
                        <div class="mb-4">
                          <div class="relative flex items-stretch w-full">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                            <div class="input-group-append">
                              <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">Go!</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <label class="sm:w-1/5 pr-4 pl-4 form-control-label">With dropdowns</label>
                      <div class="sm:w-4/5 pr-4 pl-4">
                        <div class="relative flex items-stretch w-full">
                          <div class="input-group-prepend">
                            <button data-toggle="dropdown" type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-gray-600 border-gray-600 hover:bg-gray-600 hover:text-white bg-white hover:bg-gray-700  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1">Action <span class="caret"></span></button>
                            <div class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded"><a href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0">Action</a><a href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0">Another action</a><a href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0">Something else here</a>
                              <div class="h-0 my-2 overflow-hidden border-t-1 border-gray-300"></div><a href="#" class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0">Separated link</a>
                            </div>
                          </div>
                          <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded">
                        </div>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="mb-4 flex flex-wrap ">
                      <div class="sm:w-1/3 pr-4 pl-4 sm:mx-1/5">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700">Cancel</button>
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">Save changes</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <footer class="main-footer">
        <div class="mx-auto px-2 max-w-full mx-auto">
          <div class="flex flex-wrap ">
            <div class="sm:w-1/2 pr-4 pl-4">
              <p>Your company &copy; 2017-2019</p>
            </div>
            <div class="sm:w-1/2 pr-4 pl-4 text-right">
              <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Javascript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>