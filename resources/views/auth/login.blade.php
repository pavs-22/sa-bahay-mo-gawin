<style>
body{
	background-image: url("includes/images/background2.jpg");
	background-repeat: no-repeat;
	background-size: cover;
}
form .form-group .show{
position: absolute;
right: 25px;
top: 72%;
transform: translateY(-50%);
font-size: 14px;
font-weight: 600;
user-select: none;
cursor: pointer;
display: none;
}
form .form-group .show.active{
color: #27ae60;
}

form .field .show1{
position: absolute;
right: 10px;
top: 50%;  
transform: translateY(100%);
font-size: 14px;
font-weight: 600;
user-select: none;
cursor: pointer;
color: #fff;

}
form .field .show1.active{
color: #27ae60;
}

.signin-pass,
.signup-pass {
float: right;
margin-right: 7px;
margin-top: -25px;
position: relative;
z-index: 2;
color: black;
}

.signin-show {
float: right;
margin-right: 30px;
margin-top: -25px;
position: relative;
z-index: 2;
color: black;
}

.user {
float: right;
margin-right: 7px;
margin-top: -25px;
position: relative;
z-index: 2;
color: black;
}

#notification-area {
position:fixed;
top:0px;
right:10px;
width:250px;
height:100vh;
display:flex;
flex-direction:column;
justify-content:flex-end;
}
#notification-area .notification {
position:relative;
padding:15px 10px;
background:#111;
color:#f5f5f5;
font-family:"Raleway";
font-size:14px;
font-weight:600;
border-radius:5px;
margin:5px 0px;
opacity:0;
left:20px;
animation:showNotification 500ms ease-in-out forwards;
}
@keyframes showNotification {
to {
opacity:1;
left:0px;
}
}
#notification-area .notification.success {
background:#389838;
}
#notification-area .notification.error {
background:orangered;
}
#notification-area .notification.info {
background:#00acee;
}


</style>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<title>CSP</title>
<link rel="stylesheet" href="includes/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"></link>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper" style="background-color: #fff">
<div class="title-text">
<div class="title login"><img src="includes/images/logo.jpg" style="height: 200px; border-radius: 100%;"></div>
<div class="title signup"><img src="includes/images/logo.jpg" style="height: 200px; border-radius: 100%"></div>
</div>
<div class="form-container">
<div class="slide-controls">
<input type="radio" name="slide" id="login" checked>
<input type="radio" name="slide" id="signup">
<label for="login" class="slide login">Login</label>
<label for="signup" class="slide signup">Signup</label>
<div class="slider-tab"></div>
</div><br>
<div class="form-inner">
<form action="{{route ('login')}}" method="post" class="login" style="height: 80px;" id="in">
@csrf
@if ($errors->any())
            <div class="alert alert-danger" style="overflow-y: auto; max-height: 100px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
<div class="form-group">
<input type="text" class="form-control" name="email" placeholder="Email" required>
<span class="fa fa-circle-user user"></span>
</div>
<div class="form-group">
<input type="password" id="user_pass" class="form-control" name="password" placeholder="Password" required>
<span class="fa fa-lock signin-pass"></span>
<span class="bi bi-eye-slash signin-show" id="togglePassword"></span>
</div>
<div class="pass-link"><a href="" style="color: blue" data-target="#myModals" data-toggle="modal">Forgot password?</a></div>

<div class="field btn">
<div class="btn-layer"></div>
<input type="submit" name="login" style="margin-bottom: 10px" value="LOGIN">
</div>

<div class="signup-link">Not a member? <a href="" >Signup now</a></div>
</form>
<form action="{{ route('register') }}" method="post" class="signup" id="up">
@csrf
        @if ($errors->any())
            <div class="alert alert-danger" style="overflow-y: auto; max-height: 100px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<div class="form-group">
<input type="text" class="form-control" name="name" placeholder="Name" required>
</div>

<div class="form-group">
<input type="text" class="form-control" name="email" id="username" placeholder="Email"  required>

</div>

<div class="form-group">
<input type="password" class="form-control" name="password" placeholder="Password" required>
</div>
<div class="form-group">
<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
</div>
<div class="field btn">
<div class="btn-layer"></div>
<input type="submit" name="signup" value="SIGNUP" onclick="notifySuccess()">
</div>
</form>
</div>
</div>
</div>



<script>
const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (()=>{
loginForm.style.marginLeft = "-50%";
loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (()=>{
loginForm.style.marginLeft = "0%";
loginText.style.marginLeft = "0%";
});
signupLink.onclick = (()=>{
signupBtn.click();
return false;
});
</script>


<!-- Modal -->
<div class="modal fade" id="myModals" >
<div class="modal-dialog">
<div class="modal-content" style="background:  #fff">
<div class="modal-header ftco-bg-dark ">
<h4 class="modal-title" style="color: #000">Forgot Password</h4>
<button type="button" class="close" data-dismiss="modal" style="color: black">&times;</button>
</div>
<div class="modal-body" id="message_detail">
<form method="post" action="message.php" id="message_form">

<div class="form-group">

<input type="text" name="username" class="form-control" placeholder="Username" required><br>
</div>
<div class="form-group">
<input type="password" name="password" class="form-control" placeholder="Password" required onkeyup="active()" id="pswrd_1"><br>
</div>
<div class="form-group">
<input disabled type="password" name="password" class="form-control" placeholder="Confirm Password" required onkeyup="active_2()" id="pswrd_2">
<span class="bi bi-eye-slash signin-show" id="toggleForgot"></span><br>
</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" style="background: -webkit-linear-gradient(left, #ec08d9, #ff044f);" class="btn btn-default text-white" name="sms">Update</button>
</div>
</form>
</div>
</div>
</div> 


<script>
const pswrd_1 = document.querySelector("#pswrd_1");
const pswrd_2 = document.querySelector("#pswrd_2");
const errorText = document.querySelector(".error-text");
const showBtn = document.querySelector(".show");
const btn = document.querySelector("button");
function active(){
if(pswrd_1.value.length >= 6){
btn.removeAttribute("disabled", "");
btn.classList.add("active");
pswrd_2.removeAttribute("disabled", "");
}else{
btn.setAttribute("disabled", "");
btn.classList.remove("active");
pswrd_2.setAttribute("disabled", "");
}
}
btn.onclick = function(){
if(pswrd_1.value != pswrd_2.value){
errorText.style.display = "block";
errorText.classList.remove("matched");
errorText.textContent = "Error! Confirm Password Not Match";
return false;
}else{
errorText.style.display = "block";
errorText.classList.add("matched");
errorText.textContent = "Nice! Confirm Password Matched";
return false;
}
}

const toggle1 = document.getElementById('togglePassword');
const pass1 = document.getElementById('user_pass');


toggle1.addEventListener('click', function(){
if(pass.type === "password"){
pass1.type = 'text';
}else{
pass1.type = 'password';
}
this.classList.toggle('bi-eye');
});
</script>

<script>
function checkUsername() {

jQuery.ajax({
url: "checkusername.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#check-username").html(data);
},
error:function (){}
});
}
</script>

<script>
const toggle = document.getElementById('toggleForgot');
const pass = document.getElementById('pswrd_2');


toggle.addEventListener('click', function(){
if(pass.type === "password"){
pass.type = 'text';
}else{
pass.type = 'password';
}
this.classList.toggle('bi-eye');
});

</script>

<script>
function notify(type,message){
(()=>{
let n = document.createElement("div");
let id = Math.random().toString(36).substr(2,10);
n.setAttribute("id",id);
n.classList.add("notification",type);
n.innerText = message;
document.getElementById("notification-area").appendChild(n);
setTimeout(()=>{
var notifications = document.getElementById("notification-area").getElementsByClassName("notification");
for(let i=0;i<notifications.length;i++){
if(notifications[i].getAttribute("id") == id){
notifications[i].remove();
break;
}
}
},5000);
})();
}

function notifySuccess(){
notify("success","This is demo success notification message");
}
function notifyError(){
notify("error","This is demo error notification message");
}
function notifyInfo(){
notify("info","This is demo info notification message");
}
</script>


</body>
</html>