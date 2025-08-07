import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import TeacherDashboardScreen from '../screens/Teacher/TeacherDashboardScreen';
import GradeEntryScreen from '../screens/Teacher/GradeEntryScreen';
import ClassManagementScreen from '../screens/Teacher/ClassManagementScreen';

const Tab = createBottomTabNavigator();

const TeacherNavigator = () => {
  return (
    <Tab.Navigator>
      <Tab.Screen name="Dashboard" component={TeacherDashboardScreen} />
      <Tab.Screen name="Grades" component={GradeEntryScreen} />
      <Tab.Screen name="Classes" component={ClassManagementScreen} />
    </Tab.Navigator>
  );
};

export default TeacherNavigator;
