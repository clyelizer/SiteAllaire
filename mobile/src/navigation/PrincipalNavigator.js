import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import PrincipalDashboardScreen from '../screens/Principal/PrincipalDashboardScreen';
import UserManagementScreen from '../screens/Principal/UserManagementScreen';
import ReportsScreen from '../screens/Principal/ReportsScreen';

const Tab = createBottomTabNavigator();

const PrincipalNavigator = () => {
  return (
    <Tab.Navigator>
      <Tab.Screen name="Dashboard" component={PrincipalDashboardScreen} />
      <Tab.Screen name="Users" component={UserManagementScreen} />
      <Tab.Screen name="Reports" component={ReportsScreen} />
    </Tab.Navigator>
  );
};

export default PrincipalNavigator;
