
import firebase from 'firebase/app';
import 'firebase/composer require kreait/laravel-firebase';
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";

// Initialize Firebase with your configuration
const firebaseConfig = {
    apiKey: "AIzaSyA_6MyM9pvb3jnQWYfrnmK4ue_wIwgX7e8",
    authDomain: "team-conference.firebaseapp.com",
    projectId: "team-conference",
    storageBucket: "team-conference.appspot.com",
    messagingSenderId: "645819295696",
    appId: "1:645819295696:web:9f31a6ff2fb0a58002fbd5",
    measurementId: "G-LY3GEKXMZ7"
  };

// Initialize Firebase app
firebase.initializeApp(firebaseConfig);

// Export Firebase database instance
export default firebase.database();



