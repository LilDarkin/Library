// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyDm3nX0M3930yyDOjt566lYSx5LwhuQk7w",
    authDomain: "library-e94c5.firebaseapp.com",
    databaseURL: "https://library-e94c5-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "library-e94c5",
    storageBucket: "library-e94c5.appspot.com",
    messagingSenderId: "344155630460",
    appId: "1:344155630460:web:c795588ba92bb3edf7d2f9",
    measurementId: "G-JXHVVL32FH"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);