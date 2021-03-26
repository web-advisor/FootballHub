   <!-- This File contains the Footer common to all the pages  -->
<footer class="text-lg-center text-md-center text-sm-center text-xs-center footer trillium">
    <div class="card card-link-list bg-nav-svg">
        <div class="card-block">
            <span style="color:white;"> © 2021 FootballHub</span>
            <a href="#">About</a>
            <a href="#">Help</a>
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Cookies</a>
            <a href="#">Ads </a>
            <a href="#">Info</a>
            <a href="#">Brand</a>
            <a href="#">Blog</a>
            <a href="#">Status</a>
            <a href="#">Apps</a>
            <a href="#">Jobs</a>
            <a href="#">Advertise</a>
        </div>
    </div>
</footer>   
    <!-- Include jQuery (required) and the JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>    
    <script src="assets/js/tether.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/toolkit.js"></script>
    <script src="assets/js/application.js"></script>
    <script src="dist/toolkit.min.js"></script>
    <script>
      // execute/clear BS loaders for docs
      $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
          while(BS.loader.length){(BS.loader.pop())()}
        }  
        $("#edit").click(function(){
            $('.edit input').attr('disabled',false);
            $('.edit #first').focus();
            $("#submited").show();
        }); 
        // $("#submit").click(function(){
        //     $("#submit").hide();
        // });    
      })

    
    </script>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-scrollable" id="logIn">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitleIn">Log In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            <div class="alert alert-danger" type="alert" id="alertDivIn"></div>
                            <input type="hidden" name="loginActive" class="loginActive" value="1">
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <!-- <label for="userIn">Email : </label> -->
                                <input type="text" name="userIn" id="userIn" class="form-control"
                                    placeholder="Email or Username " aria-describedby="helpId">
                            </div>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <!-- <label for="passwordIn">Password : </label> -->
                                <input type="password" class="form-control" name="passwordIn" id="passwordIn"
                                    placeholder="Password">
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success toggleLogin">Sign Up Instead</button>
                    <button type="submit" class="btn btn-primary" id="buttonIn">Log In</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

        <div class="modal-dialog modal-dialog-scrollable" id="signUp">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitleUp">Sign Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form>
                            <div class="alert alert-danger" type="alert" id="alertDivUp"></div>
                            <input type="hidden" name="loginActive" class="loginActive" value="0">
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <!-- <label for="usernameUp">Username : </label> -->
                                <input type="text" class="form-control" name="usernameUp" id="usernameUp" placeholder="Enter Username here" autofill="off">
                            </div>
                            <div class="alert alert-warning" type="alert" id="alertTaken"></div>
                            <div class="alert alert-success" type="alert" id="alertAvail"></div>
                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <!-- <label for="emailUp">Email : </label> -->
                                <input type="email" name="emailUp" id="emailUp" class="form-control"
                                    placeholder="Enter email ID here" aria-describedby="helpId">
                            </div>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <!-- <label for="passwordUp">Password : </label> -->
                                <input type="password" class="form-control" name="passwordUp" id="passwordUp"
                                    placeholder="Password">
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success toggleLogin">Log In Instead</button>
                    <button type="submit" class="btn btn-primary" id="buttonUp">Sign Up</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">

        $("#usernameUp").keyup(function(){
            $.ajax({
                type: "POST",
                // url: "/actions.php?process=namecheck",
                url:"http://localhost/FootballHub/actions.php?process=namecheck",
                data: "username=" + $("#usernameUp").val(),
                success: function (result) {
                    // alert(result);
                    if (result == 1) {
                  
                        if($("#usernameUp").val()===""){
                            $("#alertAvail").hide();
                        }else{  
                            $("#alertAvail").html("'"+$("#usernameUp").val()+"' is available. ").show();
                        }
                        $("#alertTaken").hide();
                    } else {
                  
                        if($("#usernameUp").val()===""){
                            $("#alertTaken").hide();
                        }else{    
                            $("#alertTaken").html("'"+$("#usernameUp").val()+"' is already taken. ").show();
                        }
                        $("#alertAvail").hide();
                    }
                }
            })
        });
            
        
        $(".toggleLogin").click(function () {
            if ($(".loginActive").val() == 1) {
                $(".loginActive").val("0");
                // $("#loginModalTitle").html("Sign Up");
                // $('#button').html("Sign Up");
                // $("#toggleLogin").html("Log In Instead")
                $("#signUp").show();
                $("#logIn").hide();
            } else{
            // if ($("#loginActive").val() == "0") {
                $(".loginActive").val("1");
                // $("#loginModalTitle").html("Log In");
                // $('#button').html("Log In");
                // $("#toggleLogin").html("Sign Up Instead");
                $("#signUp").hide();
                $("#logIn").show();    
            }
        });

        // To action the Log IN process
        $("#buttonIn").click(function () {
            $.ajax({
                type: "POST",
                // url: "/actions.php?process=login",
                url:"http://localhost/FootballHub/actions.php?process=login",
                data: "email=" + $("#userIn").val() + "&password=" + $("#passwordIn").val(),
                success: function (result) {
                    // alert(result);
                    if (result == 1) {
                        window.location.assign("http://localhost/FootballHub/");
                        // alert("logged in.. ");
                    } else {
                        $("#alertDivIn").html(result).show();
                    }
                }
            })
        });

        // To action the Sign UP process
        $("#buttonUp").click(function () {
            $.ajax({
                type: "POST",
                // url: "/actions.php?process=signup",
                url:"http://localhost/FootballHub/actions.php?process=signup",
                data: "username=" + $("#usernameUp").val() + "&email=" + $("#emailUp").val() + "&password=" + $("#passwordUp").val(),
                success: function (result) {
                    // alert(result);
                    if (result == 1) {
                        window.location.assign("http://localhost/FootballHub/");
                    } else {
                        $("#alertDivUp").html(result).show();
                    }
                }
            })
        });
    // To action Editing details
        $("#submited").click(function () {
            $.ajax({
                type: "POST",
                // url: "/actions.php?process=login",
                url:"http://localhost/FootballHub/actions.php?process=update",
                data: "went=" + $("#first").val() + "&worked=" + $("#worked").val() + "&lives=" + $("#lives").val() + "&belong=" + $("#belong").val(),
                success: function (result) {
                    alert(result);
                    if (result == 1) {
                        window.location.assign("http://localhost/FootballHub/?page=post");
                    } else {
                        $("#postFail").html(result).show();
                    }
                }
            });
            $("#submited").hide();
        });

        $("#postButton").click(function(){
            $.ajax({
                type: "POST",
                url : "http://localhost/FootballHub/actions.php?process=post",
                data: "postContent=" + $("#postContent").val(),
                success: function(result){
                    if(result==1){
                        $("#postSuccess").show();
                        $("#postFail").hide();
                        window.location.assign("http://localhost/FootballHub/?page=post");
                    }else if(result!=""){
                        $("#postFail").html(result).show();
                        $("postSuccess").hide();
                    }
                }
            })
        });

        $(".toggleFollow").click(function(){
            var id=$(this).attr("data-userId");
            $.ajax({
            type: "POST",
            url : "http://localhost/FootballHub/actions.php?process=toggleFollow",
            data: "userid=" + id,
            success: function(result){  
                    if(result==1){
                        $("a[data-userId='"+id+"']").html("Follow");
                        window.location.assign("http://localhost/FootballHub/?page=post");
                    }else if(result==2){
                        $("a[data-userId='"+id+"']").html("Unfollow");
                        window.location.assign("http://localhost/FootballHub/?page=post");
                    }
                }
            })
        });



    </script>
  </body>
</html>

