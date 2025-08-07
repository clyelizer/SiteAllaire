import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const StudentDashboardScreen = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Student Dashboard</Text>
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

export default StudentDashboardScreen;
