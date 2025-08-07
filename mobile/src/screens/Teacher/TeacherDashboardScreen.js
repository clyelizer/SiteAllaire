import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const TeacherDashboardScreen = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Teacher Dashboard</Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  title: {
    fontSize: 24,
  },
});

export default TeacherDashboardScreen;
