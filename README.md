# Lycée Michel Allaire - Mobile Application

This repository contains the source code for the Lycée Michel Allaire mobile application, a React Native application with an Express.js backend.

## Project Overview

The application is designed to help with the administration of the Lycée Michel Allaire school. It provides different functionalities for three user roles: Principal, Teacher, and Student.

- **Principals** can manage users and view reports.
- **Teachers** can manage grades and classes.
- **Students** can view their grades and download their report cards.

## Prerequisites

- Node.js (v18+)
- npm
- Expo CLI
- Android Studio or Xcode for running the mobile application on an emulator or a physical device.

## Backend Setup

1.  Navigate to the `backend` directory:
    ```bash
    cd backend
    ```
2.  Install the dependencies:
    ```bash
    npm install
    ```
3.  Start the backend server:
    ```bash
    npm start
    ```
    The server will start on `http://localhost:3000`.

## Frontend Setup

1.  Navigate to the `mobile` directory:
    ```bash
    cd mobile
    ```
2.  Install the dependencies:
    ```bash
    npm install
    ```
3.  Start the frontend application:
    ```bash
    npm start
    ```
    This will start the Metro bundler. You can then run the application on an Android or iOS emulator or a physical device using the Expo Go app.

## Running the Application

1.  Make sure the backend server is running.
2.  Start the frontend application.
3.  Use the Expo Go app on your mobile device to scan the QR code from the Metro bundler, or run the application on an emulator.
