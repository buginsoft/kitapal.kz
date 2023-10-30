// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: 'AIzaSyCii46DQ9lOoQzFnDIcmw4wYN-yRtejCXI',
    authDomain: 'buginsoft-c1e94.firebaseapp.com',
    databaseURL: 'https://buginsoft-c1e94.firebaseio.com',
    projectId: 'buginsoft-c1e94',
    storageBucket: 'buginsoft-c1e94.appspot.com',
    messagingSenderId: '222894391713',
    appId: '1:222894391713:android:26271e70365b57922b0be0',
    measurementId: 'G-measurement-id',
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});
