// document.getElementById("register-form").addEventListener("onsubmit", function(event){
//     event.preventDefault()
// });

function register() {
  // alert("Register");

  // console.log(document.getElementById("emailorphone").value);

  var email = document.getElementById("emailorphone").value;
  var name = document.getElementById("name").value;
  var phone = document.getElementById("phone").value;
  var password = document.getElementById("password").value;

  // alert(email+" "+password);

  firebase
    .auth()
    .createUserWithEmailAndPassword(email, password)
    .then((userCredential) => {
      // alert("inserted into firebase..");

      //ajax call
      $.ajax({
        type: "POST",
        url: "customer-registration.php",
        data: {
          email: email,
          name: name,
          phone: phone,
          password: password,
          submit: "submit",
        },
        // data:"email="+email,
        // data:"email="+email+"name="+name+"phone="+phone+"password="+password+"submit=sub",
        beforeSend: function (data) {
          //    alert("Before Ajax");
        },
        success: function (data) {
          //   alert(data); //data will contain the echo value
        },
      });

      // alert("After ajax call");

      alert("Registration Successful. Please login to continue");

      firebase
        .auth()
        .signOut()
        .then(() => {
          // Sign-out successful.

          // alert("Logout Test");

          //ajax call
          $.ajax({
            type: "POST",
            url: "delete-session.php",
            // data:"email="+$email,
            beforeSend: function (data) {
              //    alert("this test");
            },
          });

          window.location.href = "./customer-login.php";
        })
        .catch((error) => {
          // An error happened.
        });

      // window.location.href = "./product-ui.php";

      // Signed in
      // var user = userCredential.user;
      // ...
    })
    .catch((error) => {
      var errorCode = error.code;
      var errorMessage = error.message;
      // ..
      alert("catch " + errorCode + " " + errorMessage);
      console.log(errorCode + " " + errorMessage);
    });

  // var result = firebase.auth().createUserWithEmailAndPassword(email, password);

  // alert(result);
  // console.log(result);
}
