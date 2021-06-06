// var firebaseConfig = {
//     apiKey: "AIzaSyCHhyRQHmEwF9HQNb3iaM-SXhYGp-Ag31Y",
//     authDomain: "mymall-naveen.firebaseapp.com",
//     projectId: "mymall-naveen",
//     storageBucket: "mymall-naveen.appspot.com",
//     messagingSenderId: "1077253083611",
//     appId: "1:1077253083611:web:3cd5f1774a68670d3f97fe",
//     measurementId: "G-4BQC515TGN"
// };


// firebase.initializeApp(firebaseConfig);
// firebase.analytics();



function logout(){
    
    firebase.auth().signOut().then(() => {
        // Sign-out successful.

        // alert("Logout Test");

        //ajax call 
        $.ajax({  
            type:"POST",  
            url:"delete-session.php",  
            // data:"email="+$email,
            beforeSend: function(data){  
            //    alert("this test");  
            }  
        });  

        window.location.href = "./customer-login.php";


      }).catch((error) => {
        // An error happened.
      });

}



