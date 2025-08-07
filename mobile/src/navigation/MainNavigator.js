import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { useSelector } from 'react-redux';
import AuthNavigator from './AuthNavigator';
import PrincipalNavigator from './PrincipalNavigator';
import TeacherNavigator from './TeacherNavigator';
import StudentNavigator from './StudentNavigator';

const MainNavigator = () => {
  const { isAuthenticated, user } = useSelector((state) => state.auth);

  const renderNavigator = () => {
    if (!isAuthenticated) {
      return <AuthNavigator />;
    }
    switch (user.role) {
      case 'principal':
        return <PrincipalNavigator />;
      case 'teacher':
        return <TeacherNavigator />;
      case 'student':
        return <StudentNavigator />;
      default:
        return <AuthNavigator />; // Fallback to auth
    }
  };

  return <NavigationContainer>{renderNavigator()}</NavigationContainer>;
};

export default MainNavigator;
