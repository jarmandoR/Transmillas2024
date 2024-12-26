// Initialize Firebase

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyDIzuJrZMZIwOflvu7K52YTsUs4nX4EOQc",
    authDomain: "transmillas-web.firebaseapp.com",
    projectId: "transmillas-web",
    storageBucket: "transmillas-web.appspot.com",
    messagingSenderId: "740587201439",
    appId: "1:740587201439:web:8358aed5e80effc41113aa",
    measurementId: "G-Q4KVGBV5MY"
    };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

var messaging = firebase.messaging();

document.writeln(messaging);
messaging.requestPermission()
  .then(function() {
    console.log('Se han aceptado las notificaciones');
    console.log(messaging.getToken());
    return messaging.getToken();
  })
  .then(function(token) {
    if(token) {
      guardarToken(token)
    } else {
      anulaToken();
    }
  })
  .catch(function(err) {
    mensajeFeedback(err);
    console.log('No se ha recibido permiso / token: ', err);
  });

