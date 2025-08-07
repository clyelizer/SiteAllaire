import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import StudentDashboardScreen from '../screens/Student/StudentDashboardScreen';
import GradeViewScreen from '../screens/Student/GradeViewScreen';
import BulletinDownloadScreen from '../screens/Student/BulletinDownloadScreen';

const Tab = createBottomTabNavigator();

const StudentNavigator = () => {
  return (
    <Tab.Navigator>
      <Tab.Screen name="Dashboard" component={StudentDashboardScreen} />
      <Tab.Screen name="Grades" component={GradeViewScreen} />
      <Tab.Screen name="Bulletin" component={BulletinDownloadScreen} />
    </Tab.Navigator>
  );
};

export default StudentNavigator;
