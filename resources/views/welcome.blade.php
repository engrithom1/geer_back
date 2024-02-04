<!DOCTYPE html>
<html lang="en" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IMED GEER</title>
        <!-- Fonts -->
       
         <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
      
    </head>
    <body class="container">
    <h2>Geer Back-end Documentation</h2>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Auth</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">URLS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#forums" role="tab" aria-controls="forums" aria-selected="false">Forums</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>


    <div class="tab-content m-2" id="myTabContent">
        <!--Information-->
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <h4>Information</h4>
            <P>There arare three Link to consider to see the progress</P>

            <h6>Back-end API</h6>
            <p><a href="https://akiliforum.com/geer_back/api/" target="_blank"><i>https://akiliforum.com/geer_back/api/</i></a> : This is for API request where you just send request with specific and required Data.</p>
            <p>For example you can run this GET request for user ROLES <a href="https://akiliforum.com/geer_back/api/roles" target="_blank"><i>https://akiliforum.com/geer_back/api/roles</i></a> <br><i class="text-sm">Laravel v9.x, PHP v8.0 and Mysql</i></p>
            

            <h6 class="mt-4">Front-end Template</h6>
            <p>This is web template show where we what to achive, its just static Version of a real website <a href="https://imed.akiliforum.com/template/login.html" target="_blank"><i>https://imed.akiliforum.com/template/login.html</i></a><br><i class="text-sm">Html, css, javascript (bootstrap)</i></p> 
            

            <h6 class="mt-4">Real working Website</h6>
            <p>This show a real working/ functional Website <a href="https://imed.akiliforum.com/" target="_blank"><i>https://imed.akiliforum.com/</i></a>
              <br>  <i class="text-sm">Vue 3.x with Vuex</i>
            </p>
             

        </div>

        <!--authentication-->
        <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4>Authentication</h4>
             <p>Until now it has 5 Databases tables</p>
             <ul>
                <li><b>User Table :</b> <i>for user infomation and authentication data</i></li>
                <li><b>Roles Table :</b> <i>To show capability and rimitation of users</i></li>
                <li><b>Auth_tatuses Table :</b> <i>This show alot of user status in a perticular stage and permission example active user, unverified user ect</i></li>
             </ul>
             <p>Other 2 for authentication and security (Token issues).</p>
             <h6>1. Database Tables Structure</h6>
             <div class="row mb-4">
                <div class="col-md-5">
                    <p class="m-2"><b>User Table</b></p>
                    <img src="{{asset('img/user_table.JPG')}}" class="w-100" alt="" srcset="">
                </div>
                <div class="col-md-3">
                    <p class="m-2"><b>Roles Table</b></p>
                    <img src="{{asset('img/role_table.JPG')}}" class="w-100" alt="" srcset="">
                </div>
                <div class="col-md-4">
                    <p class="m-2"><b>Auth Statues Table</b></p>
                    <img src="{{asset('img/auth_status_table.JPG')}}" class="w-100" alt="" srcset="">
                </div>
             </div>
             <div>
                <h6>2. User Registration</h6>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="m-2"><b>Information</b></p>
                        <p>Method : <b>POST</b></p>
                        <p>Req_URL : <i>https://akiliforum.com/geer_back/api/register</i></p>
                    </div>
                    <div class="col-md-3">
                        <p class="m-2"><b>Request Data</b></p>
                        <code>
                        {
                            "name": "rich online"
                            "phone": "0614928525"
                            "password": "1234567890"
                        }
                        </code>
                    </div>
                    <div class="col-md-7">
                        <p class="m-2"><b>On Success</b></p>
                        <code>
                        {
                            "success": true,
                            "message": "successful registered,Receive code SMS Soon",
                            "dataz": {
                                "user": {
                                    "name": "rich online",
                                    "phone": "0614928525",
                                    "auth_statuses_id": 0,
                                    "roles_id": 1,
                                    "avatar": "avatar.JPG",
                                    "my_code": 16411,
                                    "updated_at": "2024-01-15T14:36:19.000000Z",
                                    "created_at": "2024-01-15T14:36:19.000000Z",
                                    "id": 15
                                },
                                "token": "17|XShDxkdLn9qqg1acXZx8CAkSGWUQY5mKbB3nnifO967edb0c"
                            }
                        }  
                        </code>
                    </div>
                    <div class="col-md-2">
                        <p class="m-2"><b>On Error</b></p>
                        not yet
                    </div>
                </div>

                <h6>3. Logout</h6>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="m-2"><b>Information</b></p>
                        <p>Method : <b>POST</b></p>
                        <p>Req_URL : <i>https://akiliforum.com/geer_back/api/logout</i></p>
                    </div>
                    <div class="col-md-6">
                        <p class="m-2"><b>Request Data</b></p>
                        <p>Since user is loged its needs Auth Token on request header</p>
                        <p>Bearer : 17|XShDxkdLn9qqg1acXZx8CAkSGWUQY5mKbB3nnifO967edb0c</p>
                    </div>
                    <div class="col-md-4">
                        <p class="m-2"><b>On Success</b></p>
                        <code>
                        {
                            "success": true,
                            "message": "User Logged Out"
                        }
                        </code>
                    </div>
                    <div class="col-md-2">
                        <p class="m-2"><b>On Error</b></p>
                        not yet
                    </div>
                </div>

                <h6>4. User Login</h6>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="m-2"><b>Information</b></p>
                        <p>Method : <b>POST</b></p>
                        <p>Req_URL : <i>https://akiliforum.com/geer_back/api/login</i></p>
                    </div>
                    <div class="col-md-2">
                        <p class="m-2"><b>Request Data</b></p>
                        <code>
                        {
                            "phone": "0614928525"
                            "password": "1234567890"
                        }
                        </code>
                    </div>
                    <div class="col-md-7">
                        <p class="m-2"><b>On Success</b></p>
                        <code>
                        {
                            "success": true,
                            "message": "Student phonenomber not verified",
                            "dataz": {
                                "user": {
                                    "id": 16,
                                    "name": "voda online",
                                    "phone": "0768448525",
                                    "phone_verified_at": null,
                                    "auth_statuses_id": "0",
                                    "about_me": "member at IMED-GEER",
                                    "my_code": "94420",
                                    "roles_id": "1",
                                    "avatar": "avatar.JPG",
                                    "created_at": "2024-01-15T14:53:13.000000Z",
                                    "updated_at": "2024-01-15T14:53:13.000000Z"
                                },
                                "token": "19|BzDK5FxRdv3kps67dAHDEGx8Lf18qk5i3kSkkqY8bcc3f542"
                            },
                            "auth_statuses_id": 0
                        } 
                        </code>
                    </div>
                    <div class="col-md-3">
                        <p class="m-2"><b>On Error</b></p>
                       <code>
                       {
                            "success": false,
                            "message": "Incorrect Phonenumber or Password",
                            "dataz": []
                        }
                       </code>
                    </div>
                </div>

                <h6>5. Verify Phone number</h6>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="m-2"><b>Information</b></p>
                        <p>Method : <b>POST</b></p>
                        <p>Req_URL : <i>https://akiliforum.com/geer_back/api/verify</i></p>
                        <p>Since user is loged its needs Auth Token on request header</p>
                        <p>Bearer : 17|XShDxkdLn9qqg1acXZx8CAkSGWUQY5mKbB3nnifO967edb0c</p>
                    </div>
                    <div class="col-md-3">
                        <p class="m-2"><b>Request Data</b></p>
                        <code>
                        {
                            "my_code": "45676"
                            
                        }
                        <p>Bearer Token on Header</p>
                        </code>
                    </div>
                    <div class="col-md-5">
                        <p class="m-2"><b>On Success</b></p>
                        <code>
                        {
                            "success": true,
                            "message": "Succesfull Verified",
                            "dataz": {
                                "auth_statuses_id": 1
                            }
                        }
                        </code>
                    </div>
                    <div class="col-md-4">
                        <p class="m-2"><b>On Error</b></p>
                        <code>
                        {
                            "success": false,
                            "message": "Incorrect Code"
                        }
                        </code>
                    </div>
                </div>

                <h6>6. cahange paaword</h6>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <p class="m-2"><b>Information</b></p>
                        <p>Method : <b>POST</b></p>
                        <p>Req_URL : <i>https://akiliforum.com/geer_back/api/verify</i></p>
                        <p>Since user is loged its needs Auth Token on request header</p>
                        <p>Bearer : 17|XShDxkdLn9qqg1acXZx8CAkSGWUQY5mKbB3nnifO967edb0c</p>
                    </div>
                    <div class="col-md-4">
                        <p class="m-2"><b>Request Data</b></p>
                        <code>
                        {
                            "current_password": "45676",
                            "new_password" "bobrich"
                            
                        }
                        <p>Bearer Token on Header</p>
                        </code>
                    </div>
                    <div class="col-md-4">
                        <p class="m-2"><b>On Success</b></p>
                        <code>
                        {
                            "success": true,
                            "message": "Password Changed Successfully.."
                        }
                        </code>
                    </div>
                    <div class="col-md-4">
                        <p class="m-2"><b>On Error</b></p>
                        <code>
                        {
                            "success": false,
                            "message": "Incorrect Current Password"
                        }
                        </code>
                    </div>
                </div>
                
             </div>
        </div>

        <!--authentication-->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <code> api_url:"https://akiliforum.com/geer_back/api",</br>
          img_url:"https://akiliforum.com/geer_back/back/public/storage/images/",</br>
           pdf_url:"https://akiliforum.com/geer_back/back/public/storage/pdf/",</br>
          audio_url:"https://akiliforum.com/geer_back/back/public/storage/audio/",</code>
        </div>
        <!--forums-->
        <div class="tab-pane fade" id="forums" role="tabpanel" aria-labelledby="forums-tab">
            <h6>1.Get forums/ topics for discussion</h6>
            <div class="row mb-5">
                <div class="col-md-12">
                    <p class="m-2"><b>Information</b></p>
                    <p>This return json of two array one for the top/popular posts this are only 5, others for all post. pagination not yet</p>
                    <p>Method : <b>GET</b></p>
                    <p>Req_URL : <i>https://akiliforum.com/geer_back/api/get-forum-post</i></p>
                    <p>Since user is loged its needs Auth Token on request header</p>
                </div>
                <div class="col-md-3">
                    <p class="m-2"><b>Request Data</b></p>
                    <code>
                    <p>Bearer Token on Header</p>
                    </code>
                </div>
                <div class="col-md-7">
                    <p class="m-2"><b>On Success</b></p>
                    <pre>
                    {
                    "success": true,
                    "message": "Successful get forums",
                    "dataz": {
                        "top_post": [
                            {
                                "title": "title here",
                                "id": 3,
                                "created_at": null,
                                "thumb": "forum.jpg",
                                "views": 5,
                                "description": "big text is going to happen here",
                                "avatar": "avatar.jpg",
                                "created_by": "bob admin",
                                "comments_count": 5
                            }
                        ],
                        "other_post": [
                            {
                                "title": "title here?",
                                "id": 3,
                                "created_at": null,
                                "thumb": "forum.jpg",
                                "views": 5,
                                "description": "big text is going to happen here",
                                "avatar": "avatar.jpg",
                                "created_by": "bob admin",
                                "comments_count": 5
                            }
                        ]
                    }
                }
            </pre>
                </div>
                <div class="col-md-2">
                    <p class="m-2"><b>On Error</b></p>
                    <code>
                    {
                        "success": false,
                        "message": "Incorrect Code"
                    }
                    </code>
                </div>
            </div>

            <h6>2.Get Comments for a specific forum post</h6>
            <div class="row mb-5">
                <div class="col-md-12">
                    <p class="m-2"><b>Information</b></p>
                    <p>Method : <b>POST</b></p>
                    <p>Req_URL : <i>https://akiliforum.com/geer_back/api/get-comments</i></p>
                    <p>Since user is loged its needs Auth Token on request header</p>
                </div>
                <div class="col-md-3">
                    <p class="m-2"><b>Request Data</b></p>
                    <code>
                    {
                        "forum_id": "1"
                        
                    }
                    <p>Bearer Token on Header</p>
                    </code>
                </div>
                <div class="col-md-5">
                    <p class="m-2"><b>On Success</b></p>
                    <pre>
                    {
                        "success": true,
                        "message": "Successful get comments",
                        "comments": [
                            {
                                "comment": "comments goes here",
                                "created_at": null,
                                "id": 3,
                                "likes": 8,
                                "avatar": "avatar.jpg",
                                "created_by": "bob admin"
                            },
                        ]
                    }
                    </pre>
                </div>
                <div class="col-md-4">
                    <p class="m-2"><b>On Error</b></p>
                    <code>
                    {
                        "success": false,
                        "message": "Incorrect Code"
                    }
                    </code>
                </div>
            </div>

            <h6>3.create comments</h6>
            <div class="row mb-5">
                <div class="col-md-12">
                    <p class="m-2"><b>Information</b></p>
                    <p>This return json of a comment you add with nessary data</p>
                    <p>Method : <b>POST</b></p>
                    <p>Req_URL : <i>https://akiliforum.com/geer_back/api/create-comment</i></p>
                    <p>Since user is loged its needs Auth Token on request header</p>
                </div>
                <div class="col-md-3">
                    <p class="m-2"><b>Request Data</b></p>
                    <code>
                    {
                        "forum_id": "1",
                        "comment":"your comment"
                        
                    }
                    <p>Bearer Token on Header</p>
                    </code>
                </div>
                <div class="col-md-5">
                    <p class="m-2"><b>On Success</b></p>
                    <pre>
                    {
                        "success": true,
                        "message": "Successful get comments",
                        "comment": {
                            "comment": "hello am adding anaza comment",
                            "created_at": "2024-01-27T14:22:40.000000Z",
                            "id": 10,
                            "likes": 0,
                            "avatar": "avatar.jpg",
                            "created_by": "bob admin"
                        }
                    }
                    </pre>
                </div>
                <div class="col-md-4">
                    <p class="m-2"><b>On Error</b></p>
                    <code>
                    {
                        "success": false,
                        "message": "Incorrect Code"
                    }
                    </code>
                </div>
            </div>

            <h6>4.like comment</h6>
            <div class="row mb-5">
                <div class="col-md-12">
                    <p class="m-2"><b>Information</b></p>
                    <p>This return -1 if someone oread like so its its dislike, 1 not yet like so its add like</p>
                    <p>Method : <b>POST</b></p>
                    <p>Req_URL : <i>https://akiliforum.com/geer_back/api/like-comment</i></p>
                    <p>Since user is loged its needs Auth Token on request header</p>
                </div>
                <div class="col-md-3">
                    <p class="m-2"><b>Request Data</b></p>
                    <code>
                    {
                        "comment_id": "10"
                        
                    }
                    <p>Bearer Token on Header</p>
                    </code>
                </div>
                <div class="col-md-5">
                    <p class="m-2"><b>On Success</b></p>
                    <pre>
                    {
                        "success": true,
                        "message": "Successful like",
                        "like": 1
                    }
                    </pre>
                </div>
                <div class="col-md-4">
                    <p class="m-2"><b>On Error</b></p>
                    <code>
                    {
                        "success": false,
                        "message": "Incorrect Code"
                    }
                    </code>
                </div>
            </div>

        </div>
        <!--authentication-->
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            ...
        </div>
    </div>
    <footer class="mb-3">
        <h5> NB This will constantly get updated during Development</h5>
    </footer>

    </body>
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    <!--script type="text/javascrip" src="{{asset('js/main.js')}}"></script-->
</html>
