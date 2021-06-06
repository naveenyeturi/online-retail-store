
// var firebaseConfig = {
//     apiKey: "AIzaSyCHhyRQHmEwF9HQNb3iaM-SXhYGp-Ag31Y",
//     authDomain: "mymall-naveen.firebaseapp.com",
//     projectId: "mymall-naveen",
//     storageBucket: "mymall-naveen.appspot.com",
//     messagingSenderId: "1077253083611",
//     appId: "1:1077253083611:web:3cd5f1774a68670d3f97fe",
//     measurementId: "G-4BQC515TGN"
//   };

//   firebase.initializeApp(firebaseConfig);
//     firebase.analytics();

firebase.auth().onAuthStateChanged(function(user) {
    // user="naveen";
    if (user) {
      // User is signed in.
    //   alert("login success");

    //   console.log(user.email);

      $email = user.email;


      //ajax call 
      $.ajax({  
        type:"POST",  
        url:"set-session.php",  
        data:"email="+$email,
        beforeSend: function(data){  
        //    alert("this test");  
        }  
     });  




    window.location.href = "./product-ui.php";

    } else {
      // No user is signed in.
    //   alert(user);
    //   alert("login fail");
    }
});




function validate(){
    // alert("Test");

    var email = document.getElementById("emailorphone").value;

    var password = document.getElementById("password").value;

    // alert("Test1");

    firebase.auth().signInWithEmailAndPassword(email, password) 
    .then((userCredential) => {
        // Signed in
        // window.alert("Test3");
        var user = userCredential.user;

        // alert(user);

        // window.location.href = "../internship-project/product-ui.php";

        
        // ...
    })
    .catch((error) => {
        // window.alert("Test2");
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorMessage);
    });

    
    // var result = firebase.auth().signInWithEmailAndPassword(email, password);
    // alert("Test...");
    // alert(result);
    // console.log(result);
}

